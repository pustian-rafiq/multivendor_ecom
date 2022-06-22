<?php

namespace App\Http\Controllers;

use App\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::latest()->get();
        return view('backend.brand.index',compact('brands'));
    }


     // Chnage banner status
     public function ChangeStatus(Request $request){
       
        if($request->mode =='true'){
            DB::table('brands')->where('id',$request->id)->update(['status'=>'active']);
        }else{
            DB::table('brands')->where('id',$request->id)->update(['status'=>'inactive']);
        }
        return response()->json(['msg'=>'Status updated successfully','status'=>true]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $this->validate($request,[
            'title' => 'string|required',
            'photo' => 'required',
            'status' => 'nullable|in:active,inactive',
        ]);

        $data = new Brand();

        $data->title = $request->title;
        $data->photo = $request->photo;
        $data->status = $request->status;
       
        $slug = Str::slug($request->title);

        $data->slug =  $slug;

        //return $data;
        $existingSlug = Brand::where('slug',$slug)->count();

        if($existingSlug){
            $slug = time().'-'.$slug;
        } 

       $result = $data->save();
       if($result){
        return redirect()->route('brand.index')->with('success','Brand inserted successfully');
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
        $brand = Brand::find($id);
        return view('backend.brand.edit',compact('brand'));
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
