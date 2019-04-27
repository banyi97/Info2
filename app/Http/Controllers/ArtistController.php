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

        return view('artist.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('album.create');
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
        foreach($request as $song)
        return view('album.show')->with();
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
        $query = DB::table('songs')
            ->select( 'songs.*', 'artists.id as artist_id', 'artists.name as artist_name', 'artists.pic_url as artist_pic','albums.id as album_album_id' , 'albums.title as album_title', 'albums.pic_url as album_pic', 'albums.release_date as album_year' )
            ->rightJoin('albums', 'albums.id', '=', 'songs.album_id')
            ->rightJoin('artists', 'artists.id', '=', 'albums.artist_id')
            ->where('artists.id', $id)
            ->orderby('songs.album_id')
            ->orderby('songs.number_of')
            ->get();           
     
        $ret = array();
        foreach($query as $item){
            $ret['id'] = $item->artist_id;
            $ret['name'] = $item->artist_name;
            $ret['pic_url'] = $item->artist_pic;
            $ret['albums'] = array();
            foreach($query as $albums){
                if($this->checkElement($ret['albums'],$albums) == true)
                    continue;
                $album = [
                    'id' => $albums->album_album_id,
                    'title' => $albums->album_title,
                    'year' => $albums->album_year,
                    'pic_url' => $albums->album_pic,
                    'songs' => array()
                ];
                foreach($query as $item){
                    if($item->album_id != $album['id'])
                        continue;
                    $song = [
                        'id' => $item->id,
                        'title' => $item->title,
                        'number_of' => $item->number_of,
                        'url' => "URL helye",
                        'song_length' => $item->length
                    ];
                    $album['songs'][] = $song;
                }
                $ret['albums'][] = $album;
            }
            break;
        }
    //    return response()->json(['success' => $ret], 200);
        return view('artist.show')->with(
            [              
                'artist'=> json_encode( $ret )
            ]
        );
    }
    private function checkElement($array, $query){
        foreach($array as $check){
            if($check['id'] == $query->album_album_id)
             return true;
        }
        return false;
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
        return view('artist.edit');
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
        return view('artist.show');
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
        return view('artist.show');
    }
}
