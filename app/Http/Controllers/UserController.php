<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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

    public function me()
    {
        //
        $user = Auth::user();
        
        return view('user')->with([
            'user'=> json_encode( $user )
        ]);
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

    public function changePassword(Request $request)
    {
        //
        //  'password' => ['required', 'string', 'min:8', 'confirmed'],
        $user = Auth::user();
        /*
        if(Hash::check($user->password, Hash::make($request->oldpassword))){

            $user->password = Hash::make($request->newpassword);
            $user->save();
        
            return response()->json(['success' => 'Ok'], 200);
        } */

        if(!Hash::check($request->oldpassword, $user->password)){
            return response()->json(['error' => 'error'], 400);
        }else{
            $user->password = Hash::make($request->newpassword);
            $user->save();
        
            return response()->json(['success' => 'Ok'], 200);
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
        //
        if(DB::table('users')->where('users.id', '=', $id)->delete()){
            return response()->json(['success' => 'Ok'], 200);
        }
        
        return response()->json(['error' => 'Error'], 400);
    }

    public function destroyMe()
    {
        //
        $user = Auth::user();

        if(DB::table('users')->where('users.id', '=', $user->id)->delete()){
            return response()->json(['success' => 'Ok'], 200);
        }
        
        return response()->json(['error' => 'Error'], 400);
    }
}
