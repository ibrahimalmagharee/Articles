<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\TagRequest;
use App\Models\Tag;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use DB;

class TagController extends Controller
{
    public function index(Request $request)
    {
        $tags = Tag::all();
        if ($request->ajax()) {

            return DataTables::of($tags)
                ->addIndexColumn()

                ->addColumn('status', function ($row) {
                    return $row->status == 1 ? 'Active' : 'Not Active';
                })

                ->addColumn('action', function ($row) {
                    $url = route('edit.tag', $row->id);
                    $btn = '<td><a href="' . $url . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="تعديل" class="primary box-shadow-3 mb-1 editTag" style="width: 80px"><i class="la la-edit font-large-1"></i></a></td>';
                    $btn .= '&nbsp;&nbsp;';
                    $btn = $btn . ' <td><a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="حذف" class="danger box-shadow-3 mb-1 deleteTag" style="width: 80px"><i class="la la-trash font-large-1"></i></a></td>';
                    return $btn;
                })
                ->rawColumns(['action', 'status'])
                ->make(true);

        }
        return view('admin.tag.index');
    }

    public function store(TagRequest $request)
    {
        DB::beginTransaction();

        if (!$request->has('status')) {
            $request->request->add(['status' => 0]);

        } else {
            $request->request->add(['status' => 1]);

        }

        $tag = Tag::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'status' => $request-> status,
        ]);

        $tag->save();

        DB::commit();


        return response()->json([
            'status' => true,
            'msg' => 'The tag has been added successfully'
        ]);
    }

    public function edit($id)
    {
        $tag = Tag::find($id);

        $notification = array(
            'message' => 'This tag is not available',
            'alert-type' => 'error'
        );

        if (!$tag)
            return redirect()->route('index.tags')->with($notification);

        return view('admin.tag.edit', compact('tag'));
    }

    public function update($id, TagRequest $request)
    {
        $tag = Tag::find($id);

        $notification = array(
            'message' => 'This tag is not available',
            'alert-type' => 'error'
        );

        if (!$tag)
            return redirect()->route('index.tags')->with($notification);

        DB::beginTransaction();

        if (!$request->has('status')) {
            $request->request->add(['status' => 0]);

        } else {
            $request->request->add(['status' => 1]);

        }

        $tag->where('id' , $id)->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'status' => $request-> status,
        ]);

        DB::commit();

        $notification = array(
            'message' => 'This tag has been successfully updated',
            'alert-type' => 'info'
        );


        return redirect()->route('index.tags')->with($notification);
    }

    public function destroy($id)
    {

        $tag = Tag::find($id);

        if (!$tag) {
            return response()->json([
                'status' => false,
                'msg' => 'This tag is not available',
            ]);
        } else {
            $tag->delete();

            return response()->json([
                'status' => true,
                'msg' => 'The tag has been successfully deleted',
            ]);
        }


    }
}
