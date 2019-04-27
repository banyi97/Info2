<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
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
    public function show($key)
    {
        //
        $artists = DB::table('artists')
            ->select('artists.id', 'artists.name', 'artists.pic_url')
            ->where('artists.name', 'like', '%'.$key.'%')
            ->take(5)
            ->get();  
        
        $albums = DB::table('albums')
            ->select('albums.id', 'albums.title', 'albums.pic_url', 'albums.artist_id', 'artists.name as artist_name')
            ->join('artists', 'artists.id', '=', 'albums.artist_id')
            ->where('albums.title', 'like', '%'.$key.'%')
            ->take(5)
            ->get();

        $songs = DB::table('songs')
            ->select('songs.id', 'songs.title', 'songs.album_id', 'albums.title as album_title', 'artists.id as artist_id', 'artists.name as artist_name', 'albums.pic_url as pic_url')
            ->join('albums', 'songs.album_id', '=', 'albums.id')
            ->join('artists', 'artists.id', '=', 'albums.artist_id')
            ->where('songs.title', 'like', $key)
            ->take(5)
            ->get(); 

        $ret = array();

        foreach($artists as $artist){
            $ret['artists'][] = $artist;
        }
        foreach($albums as $album){
            $ret['albums'][] = $album;
        }
        foreach($songs as $song){
            $ret['songs'][] = $song;
        }
        
        return response()->json(['success' => $ret], 200);
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
