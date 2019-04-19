<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlbumController extends Controller
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
        $query = DB::table('songs')
            ->select( 'songs.*', 'albums.title as album_title', 'albums.release_date', 'artists.name', 'albums.pic_url')
            ->join('albums', 'songs.album_id', '=', 'albums.id')
            ->join('artists', 'artists.id', '=', 'albums.artist_id')
            ->where('albums.id', $id)
            ->orderby('number_of')
            ->get();         
    
        $ret = array();
        foreach($query as $item){
            $ret['id'] = $item->album_id;
            $ret['title'] = $item->album_title;
            $ret['year'] = $item->release_date;
            $ret['pic'] = $item->pic_url;
            $ret['songs'] = array();
            foreach($query as $songs){
                $song = [
                    'id' => $songs->id,
                    'title' => $songs->title,
                    'number_of' => $songs->number_of,
                    'url' => "URL helye",
                    'song_length' => $songs->length
                ];
                array_push($ret['songs'], $song);
            }
            break;
        }

        return view('admin')->with(
            [              
                'album'=> json_encode( $ret ),
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
