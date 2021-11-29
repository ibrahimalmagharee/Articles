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
        $articles = Article::all();

        if ($request->ajax()) {

            return DataTables::of($articles)
                ->addIndexColumn()

                ->editColumn('tags', function ($row){
                    return \GuzzleHttp\json_decode($row->tags->map(function ($tag){
                        return $tag->name;
                    }));
                })

                ->editColumn('short_description', function ($row){
                    return Str::limit($row->short_description, 50);

                })

                ->addColumn('photo', function ($row){
                    return '<img src="' . $row->getPhoto($row->images[0]->photo) . '" border="0" style="width: 100px; height: 90px;" class="img-rounded" align="center" />';

                })


                ->addColumn('action', function ($row) {
                    $url = route('edit.article', $row->id);
                    $btn = '<td><a href="' . $url . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="تعديل"  class="primary box-shadow-3 mb-1 editArticle" style="width: 80px"><i class="la la-edit font-large-1"></i></a></td>';
                    $btn .= '&nbsp;&nbsp;';
                    $btn = $btn . ' <td><a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="حذف" class="danger box-shadow-3 mb-1 deleteArticle" style="width: 80px"><i class="la la-trash font-large-1"></i></a></td>';
                    return $btn;
                })
                ->rawColumns(['action', 'tags', 'short_description', 'photo'])
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

        return view('admin.article.edit', compact('article'), $data);
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

//    public function addProductImages($product_id)
//    {
//        $product = Product::with('images')->find($product_id);
//        return view('admin.product.addImages', compact('product'));
//    }

    public function saveImagesOfArticleInDB(ImageRequest $request)
    {
        if ($request->has('images') && count($request->images) > 0) {
            foreach ($request->images as $image) {
                Image::create([
                    'imageable_id' => $request->article_id,
                    'imageable_type' => 'App\Models\Article',
                    'photo' => $image
                ]);
            }
        }

        $notification = array(
            'message' => 'Success add images',
            'alert-type' => 'success'
        );
        return redirect()->route('index.article')->with($notification);


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
