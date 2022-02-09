<?php

namespace App\Http\Controllers;

use App\Models\User;
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
        $users = User::all();
        return view('user')->with('users',$users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
        $this->validate(request(), [
            'fname' => 'required',
            'lname' => 'required',
            'dob' => 'required',
            'gender' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'password' => 'required',
            'confirmpassword' => 'required|same:password'
        ]);

        $userObj = new User;

        $userObj -> fname = $request->input('fname');
        $userObj -> lname = $request->input('lname');
        $userObj -> dob = $request->input('dob');
        $userObj -> gender = $request->input('gender');
        $userObj -> email = $request->input('email');
        $userObj -> mobile = $request->input('mobile');
        $userObj -> password = $request->input('password');

        try{
            $userObj -> save();
        } catch(\Exception $e){
            return redirect('/viewall')->with('error','Invalid credentials');
        }

        return redirect('/viewall')->with('success','Data Saved Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return response()->json([
            'status'=> 200,
            'user'=> $user,
        ]);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user_id = $request->input('user_id');
        $user = User::find($user_id);
        $user->fname = $request->input('fname');
        $user->lname = $request->input('lname');
        $user->dob = $request->input('dob');
        $user->gender = $request->input('gender');
        $user->email = $request->input('email');
        $user->mobile = $request->input('mmobile');
        $user->update();
        return redirect('/viewall')->with('success','Data Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $user_id = $request->input('delete_id');
        $user = User::find($user_id);
        $user->delete();
        return redirect('/viewall')->with('success','User Deleted Successfully');
    }
}
