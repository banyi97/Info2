<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArtistController extends Controller
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
        return view('');
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
        $query = DB::table('artists')
            ->select( 'songs.*','albums.title as album_title', 'albums.pic_url as album_pic', 'artists.name as artist_name', 'artists.pic_url as artist_pic', 'artists.id as artist_id')
            ->join('albums', 'artists.id', '=', 'albums.artist_id')
            ->join('songs', 'albums.id', '=', 'songs.album_id')
            ->where('artists.id', $id)
            ->orderby('songs.album_id')
            ->orderby('songs.number_of')
            ->get();           

        $songs = [];
        foreach($query as $item){
            $song = [
                'id' => $item->id,
                'title' => $item->title,
                'number_of' => $item->number_of,
                'url' => "URL helye",
                'song_length' => $item->length
            ];
            array_push($songs, $song);
        };

        $albums = [];
        foreach($songs as $item){
            foreach($albums as $check){
                if($item->id == $check->album_id){
                    array_push($check, $item);
                }
            }

            $album = [
                'id' => $item->album_id,
                'title' => $item->album_title,
                'year' => $item->year,
                'pic' => 'hello',
                'songs' => []
            ]; 
            array_push($album->songs, $item);
            array_push($albums, $album);
        }
              
        $ret = [
            'id' => $query[0]->artist_id,
            'title' => $query[0]->artist_name,
            'pic' => $query[0]->artist_pic,
            'albums' => $albums
        ]; 
                        
        return view('admin')->with(
            [              
                'artist'=> json_encode( $ret ),
                'query' => json_encode( $query)
            ]
        );
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
