<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
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
        $query = DB::table('users')
            ->select('users.id', 'users.email', 'users.name', 'users.created_at', 'users.updated_at')      
            ->get();  

        $query_artists = DB::table('artists')
            ->select('artists.*')
            ->orderby('artists.id')
            ->get(); 

        $query_albums = DB::table('albums')
            ->select( 'albums.*', 'artists.name as artist_name')
            ->join('artists', 'artists.id', '=', 'albums.artist_id') 
            ->orderby('artists.id')
            ->orderby('albums.release_date')       
            ->get(); 

        $users = array();
        $albums = array();
        $artists= array();
        foreach($query as $user){
            $data = array();
            $data['id'] = $user->id;
            $data['name'] = $user->name;
            $data['email'] = $user->email;
            $data['created_at'] = $user->created_at;
            $data['updated_at'] = $user->updated_at;
            $users['user'][] = $data;
        }
        foreach($query_artists as $artist){
            $data = array();
            $data['id'] = $artist->id;
            $data['name'] = $artist->name;
            $data['created_at'] = $artist->created_at;
            $data['updated_at'] = $artist->updated_at;
            $artists['artist'][] = $data;
        }
        foreach($query_albums as $album){
            $data = array();
            $data['id'] = $album->id;
            $data['title'] = $album->title;
            $data['artist_name'] = $album->artist_name;
            $data['year'] = $album->release_date;
            $data['created_at'] = $album->created_at;
            $data['updated_at'] = $album->updated_at;
            $albums['album'][] = $data;
        }
        return view('admin')->with([
            'users'=> json_encode( $users ),
            'artists' => json_encode( $artists ),
            'albums' => json_encode( $albums )
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('create');
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
