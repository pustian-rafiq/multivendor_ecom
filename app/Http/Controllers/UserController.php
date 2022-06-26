<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->get();
        return view('backend.user.index',compact('users'));
    }


      // Chnage product status
      public function ChangeStatus(Request $request){
       
        if($request->mode =='true'){
            DB::table('users')->where('id',$request->id)->update(['status'=>'active']);
        }else{
            DB::table('users')->where('id',$request->id)->update(['status'=>'inactive']);
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
        return view('backend.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            "username" => "nullable|string",
            "full_name" => "required|string",
            "email" => "required|email|unique:users,email",
            "password" => "required|min:6",
            "phone" => "nullable|string",
            "photo" => "required",
            "address" => "nullable|string",
            "role" => "required|in:admin.vendor,customer",
            "status" => "required|in:active,inactive",
        ]);


        $data = new User();

        $data->full_name = $request->full_name;
        $data->username = $request->username;
        $data->email = $request->email;
        $data->password = $request->password;
        $data->phone = $request->phone;
        $data->photo = $request->photo;
        $data->address = $request->address;
        $data->role = $request->role;
        $data->status = $request->status;
       
         
       $result = $data->save();
       if($result){
        return redirect()->route('user.index')->with('success','User is inserted successfully');
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
        $user = User::find($id);
        return view('backend.user.edit',compact('user'));
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
        $data = User::find($id);

       // return $data->id;
        $this->validate($request,[
            "username" => "nullable|string",
            "full_name" => "required|string",
            "email" => "required|email|unique:users,email,".$data->id,
            "password" => "required|min:6",
            "phone" => "nullable|string",
            "photo" => "required",
            "address" => "nullable|string",
            "role" => "required|in:admin.vendor,customer",
            "status" => "required|in:active,inactive",
        ]);


       

        $data->full_name = $request->full_name;
        $data->username = $request->username;
        $data->email = $request->email;
        $data->password = $request->password;
        $data->phone = $request->phone;
        $data->photo = $request->photo;
        $data->address = $request->address;
        $data->role = $request->role;
        $data->status = $request->status;
       
         
       $result = $data->save();
       if($result){
        return redirect()->route('user.index')->with('success','User is updated successfully');
       }else{
           return back()->with('error','Something went wrong');
       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = User::find($id);

        if($data){
            $data->delete();
            //unlink(public_path($data->photo));
            return redirect()->route('user.index')->with('success','User deleted successfully');
        }else{
            return redirect()->back()->with('error','Something went wrong');
        }
    }
}
