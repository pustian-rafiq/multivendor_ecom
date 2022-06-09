<?php

namespace App\Http\Controllers;

use App\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::latest()->get();
        return view('backend.banners.index',compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.banners.create');
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
            'description' => 'required',
            'photo' => 'required',
            'condition' => 'nullable|in:banner,promo',
            'status' => 'nullable|in:active,inactive',
        ]);

        $data = new Banner();

        $data->title = $request->title;
        $data->description = $request->description;
        $data->photo = $request->photo;
        $data->condition = $request->condition;
        $data->status = $request->status;
       
       $slug = Str::slug($request->title);

        $data->slug =  $slug;

        //return $data;
        $existingSlug = Banner::where('slug',$slug)->count();

        if($existingSlug){
            $slug = time().'-'.$slug;
        } 

       $result = $data->save();
       if($result){
        return redirect()->route('banner.index')->with('success','Banner inserted successfully');
       }else{
           return back()->with('error','Something went wrong');
       }
    }
    // Chnage banner status
    public function ChangeStatus(Request $request){
       
        if($request->mode =='true'){
            DB::table('banners')->where('id',$request->id)->update(['status'=>'active']);
        }else{
            DB::table('banners')->where('id',$request->id)->update(['status'=>'inactive']);
        }
        return response()->json(['msg'=>'Status updated successfully','status'=>true]);
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
        //
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
