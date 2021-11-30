<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ArticleRequest;
use App\Http\Requests\Dashboard\ImageRequest;
use App\Models\Article;
use App\Models\Image;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use DB;
class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $articles = Article::orderBy('id', 'DESC')->get();

        if ($request->ajax()) {

            return DataTables::of($articles)
                ->addIndexColumn()


                ->editColumn('title', function ($row){
                    return Str::limit($row->title, 40);

                })

                ->editColumn('slug', function ($row){
                    return Str::limit($row->slug, 40);

                })

                ->editColumn('short_description', function ($row){
                    return Str::limit($row->short_description, 40);

                })

                ->addColumn('status', function ($row) {
                    $class = '';
                    $class1 = '';
                    if ($row->status == 0) {
                        $class1 = 'hidden';

                    } else {
                        $class = 'hidden';
                    }

                    return $status = '<td>
                        <a href="javascript:void(0)"  data-toggle="tooltip" data-status="' . $row->status . '"  data-id="' . $row->id . '" id="un_published_' . $row->id . '"  class="btn btn-info box-shadow-3 mb-1 '.$class.' changeStatus" style="width: 100px">Unpublished</a>
                        <a href="javascript:void(0)"  data-toggle="tooltip" data-status="' . $row->status . '"  data-id="' . $row->id . '" id="published_' . $row->id . '"  class="btn btn-warning box-shadow-3 mb-1 '.$class1.' changeStatus" style="width: 95px">Published</a>
                        </td>';
                })



                ->addColumn('action', function ($row) {
                    $url = route('edit.article', $row->id);
                    $btn = '<td><a href="' . $url . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="تعديل"  class="primary box-shadow-3 mb-1 editArticle" style="width: 80px"><i class="la la-edit font-large-1"></i></a></td>';
                    $btn .= '&nbsp;&nbsp;';
                    $btn = $btn . ' <td><a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="حذف" class="danger box-shadow-3 mb-1 deleteArticle" style="width: 80px"><i class="la la-trash font-large-1"></i></a></td>';
                    return $btn;
                })
                ->rawColumns(['action', 'tags', 'short_description', 'status'])
                ->make(true);

        }
        return view('admin.article.index');
    }

    public function create()
    {
        $tags = Tag::active()->selection()->get();

        return view('admin.article.create', compact('tags'));
    }

    public function store(ArticleRequest $request)
    {
        DB::beginTransaction();

        if (!$request->has('status')) {
            $request->request->add(['status' => 0]);

        } else {
            $request->request->add(['status' => 1]);

        }

        $article = Article::create([
           'title' => $request-> title,
           'slug' => $request-> slug,
           'short_description' => $request-> short_description,
           'description' => $request-> description,
           'status' => $request-> status,
        ]);

        $article->save();

        if ($request->has('images') && count($request->images) > 0) {
            foreach ($request->images as $image) {
                $image = Image::create([
                    'photo' => $image
                ]);

                $article->images()->save($image);
            }
        }

        $article->tags()->attach($request->tags);

        DB::commit();


        $notification = array(
            'message' => 'The article has been added successfully',
            'alert-type' => 'success'
        );


        return redirect()->route('index.articles')->with($notification);

    }

    public function edit($id)
    {
        $article = Article::find($id);
        $data = [];
        $data['tags'] = Tag::active()->selection()->get();

        $notification = array(
            'message' => 'This article is not available',
            'alert-type' => 'error'
        );

        if (!$article)
            return redirect()->route('index.articles')->with($notification);

        $article_tags = collect();
        foreach ($article->tags as $tags){
            $article_tags []= $tags;

        }

        return view('admin.article.edit', compact('article', 'article_tags'), $data);
    }

    public function update($id, ArticleRequest $request)
    {
        $article = Article::find($id);

        $notification = array(
            'message' => 'This article is not available',
            'alert-type' => 'error'
        );

        if (!$article)
            return redirect()->route('index.articles')->with($notification);

        DB::beginTransaction();

        if (!$request->has('status')) {
            $request->request->add(['status' => 0]);

        } else {
            $request->request->add(['status' => 1]);

        }

        $article->where('id', $id)->update([
            'title' => $request-> title,
            'slug' => $request-> slug,
            'short_description' => $request-> short_description,
            'description' => $request-> description,
            'status' => $request-> status,
        ]);

        if ($request->has('images') && count($request->images) > 0) {
            foreach ($request->images as $image) {
                $image = Image::create([
                    'photo' => $image
                ]);

                $article->images()->save($image);
            }
        }

        $article->tags()->sync($request->tags);

        DB::commit();

        $notification = array(
            'message' => 'This article has been successfully updated',
            'alert-type' => 'info'
        );


        return redirect()->route('index.articles')->with($notification);
    }

    public function changeStatus (Request $request)
    {
        $status = $request->status;
        $article = Article::where('id', request('article_id'))->first();
        if ($request->status == 0){
            $status = 1;
        }elseif ($request->status == 1) {
            $status = 0;
        }

        $article->where('id', request('article_id'))->update([
            'status' => $status
        ]);


        return response()->json([
            'status' => true ,
            'article_status' => $status ,
            'msg' => 'Article status updated successfully'
        ]);
    }
    

    public function saveImagesOfArticleInFolder(Request $request)
    {

        $image = $request->file('dzfile');
        $fileName = uploadImage('article', $image);

        return response()->json([
            'name' => $fileName,
            'original_name' => $image->getClientOriginalName(),
        ]);

    }

    public function deleteImagesOfArticle(Request $request)
    {
        $article_image = Image::find($request->image_id);
        $article = $article_image->imageable;
        $path = public_path('assets/images/article/') . $article_image->photo;
        unlink($path);
        $article_image->delete();
        $image_count = count($article->images);
        return response()->json([
            'status' => true,
            'image_count' => $image_count,
            'msg' => 'The image has been deleted successfully'
        ]);

    }

    public function destroy($id)
    {

        $article = Article::find($id);

        if (!$article) {
            return response()->json([
                'status' => false,
                'msg' => 'This article is not available',
            ]);
        } else {
            foreach ($article->images as $img){
                $image_path = public_path('assets/images/article/') . $img->photo;
                unlink($image_path);
                $img->delete();
            }
            $article->delete();

            return response()->json([
                'status' => true,
                'msg' =>'The article has been deleted successfully',
            ]);
        }


    }
}
