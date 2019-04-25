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
    public function create($artistid)
    {
        //
        $ret = array();
        $ret['artistid'] = $artistid; 
        return view('album.create')->with(
            [
                'artist' => json_encode( $ret )
            ]
        );
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
       // $ret = $request->album['songs'][0]['title'];
        if(isset($request->album)){
            if(DB::table('albums')->insert(
                [
                    'title' => $request->album['title'],
                    'release_date' => $request->album['year'],
                    'artist_id' => $request->album['artistid']
                ]
            )){
                $id = DB::table('albums')
                        ->select('id')
                        ->where([
                            ['albums.title', '=', $request->album['title']],
                            ['albums.release_date', '=', $request->album['year']],
                            ['albums.artist_id', '=', $request->album['artistid']]
                        ])
                        ->get();                         
                foreach($request->album['songs'] as $song){
                    DB::table('songs')->insert(
                        [
                            'title' => $song['title'],
                            'number_of' => $song['number_of'],
                            'album_id' => $id[0]->id,
                            'length' => 555
                        ]);
                }       
            }         
        }
        
      //  foreach($request->album->songs as $song){       }   
        return response()->json(['success' => $id[0]->id], 200);
        
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
            ->select( 'songs.*', 'albums.title as album_title', 'albums.id as album_id' , 'albums.release_date', 'albums.pic_url', 'artists.name as artist_name', 'artists.id as artist_id')
            ->join('albums', 'songs.album_id', '=', 'albums.id')
            ->join('artists', 'artists.id', '=', 'albums.artist_id')
            ->where('albums.id', $id)
            ->orderby('number_of')
            ->get();         
    
        $ret = array();
        foreach($query as $item){
            $ret['id'] = $item->album_id;
            $ret['artist_id'] = $item->artist_id;
            $ret['artist'] = $item->artist_name;
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
                $ret['songs'][] = $song;
            }
            break;
        }
        
        return view('album.show')->with(
            [              
                'album'=> json_encode( $ret )
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
        $query = DB::table('songs')
            ->select( 'songs.*', 'albums.title as album_title', 'albums.id as album_id' , 'albums.release_date', 'albums.pic_url', 'artists.name as artist_name', 'artists.id as artist_id')
            ->join('albums', 'songs.album_id', '=', 'albums.id')
            ->join('artists', 'artists.id', '=', 'albums.artist_id')
            ->where('albums.id', $id)
            ->orderby('number_of')
            ->get();     

            $ret = array();
            foreach($query as $item){
                $ret['id'] = $item->album_id;
                $ret['artist_id'] = $item->artist_id;
                $ret['artist'] = $item->artist_name;
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
                    $ret['songs'][] = $song;
                }
                break;
            }

            $artist = array();
            $artist['album'] = $ret;
            $artist['ismodify'] = true;
            $artist['artistid'] = $ret['artist_id'];
            
            return view('album.edit')->with(
                [              
                    'artist'=> json_encode( $artist )
                ]
            );
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
        return view('album.show');
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
