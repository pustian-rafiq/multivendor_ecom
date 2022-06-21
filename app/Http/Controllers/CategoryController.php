<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->get();
        return view('backend.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parentCategories = Category::where('is_parent',1)->orderBy('title','asc')->get();
        return view('backend.category.create',compact('parentCategories'));
    }

     // Chnage banner status
     public function ChangeStatus(Request $request){
       
        if($request->mode =='true'){
            DB::table('categories')->where('id',$request->id)->update(['status'=>'active']);
        }else{
            DB::table('categories')->where('id',$request->id)->update(['status'=>'inactive']);
        }
        return response()->json(['msg'=>'Status updated successfully','status'=>true]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Check validation
       $this->validate($request,[
        "title" => "required|string",
        "summary" => "string|nullable",
        "is_parent" => "sometimes|in:1",
        "parent_id" => "nullable",
        "status" => "nullable|in:active,inactive",
       ]);

       $data = new Category();

       $data->title = $request->title;
       $data->summary = $request->summary;
       $data->photo = $request->photo;
       $data->is_parent = $request->is_parent ? $request->is_parent : 0;
       $data->parent_id = $request->parent_id;
       $data->status = $request->status;
      
      $slug = Str::slug($request->title);

       $data->slug =  $slug;

       //return $data;
       $existingSlug = Category::where('slug',$slug)->count();

       if($existingSlug){
           $slug = time().'-'.$slug;
       } 

      $result = $data->save();
      if($result){
       return redirect()->route('category.index')->with('success','Category inserted successfully');
      }else{
          return back()->with('error','Something went wrong');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $parentCategories = Category::where('is_parent',1)->orderBy('title','asc')->get();
        if($category){
            return view('backend.category.edit',compact('category','parentCategories'));
        }else{
            return "Category not found";
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
