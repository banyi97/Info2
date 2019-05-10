<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
    public function create($id)
    {
        //
        $query = DB::table('artists')
            ->select('*')
            ->where('artists.id', $id)
            ->get();   

        $album = array();
        $album['artist_id'] = isset($query[0]) ? $query[0]->id : abort(404);
        $album['artist_name'] = isset($query[0]) ?  $query[0]->name : abort(404);
        
        $ret = array();
        $ret['ismodify'] = false; 
        $ret['album'] = $album;

    //    return response()->json(['success' => $ret], 200);

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
        if(isset($request->album)){
            $datetime = date("Y-m-d H:i:s");
            $ret = array();
            $id = DB::table('albums')->insertGetId(
                [
                    'title' => $request->album['title'],
                    'release_date' => $request->album['year'],
                    'artist_id' => $request->album['artistid'],
                    'created_at' => $datetime,
                    'updated_at' => $datetime
                ]);    
                $ret['album_id'] = $id;                  
                foreach($request->album['songs'] as $song){
                    $songid = DB::table('songs')->insertGetId(
                        [
                            'title' => $song['title'],
                            'number_of' => $song['number_of'],
                            'album_id' => $id,
                            'length' => $song['number_of'],
                            'created_at' => $datetime,
                            'updated_at' => $datetime
                        ]);
                        $ret['song_id'][] = $songid;
                }       
            }               
        return response()->json(['success' => $ret], 200);  
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
            ->select( 'songs.*', 'albums.title as album_title', 'albums.id as album_album_id' , 'albums.release_date', 'albums.pic_url', 'artists.name as artist_name', 'artists.id as artist_id')
            ->rightJoin('albums', 'songs.album_id', '=', 'albums.id')
            ->rightJoin('artists', 'artists.id', '=', 'albums.artist_id')
            ->where('albums.id', $id)
            ->orderby('number_of')
            ->get();         
    
        $ret = array();
        foreach($query as $item){
            $ret['id'] = $item->album_album_id;
            $ret['artist_id'] = $item->artist_id;
            $ret['artist'] = $item->artist_name;
            $ret['title'] = $item->album_title;
            $ret['year'] = $item->release_date;
            $ret['pic_url'] = $item->pic_url;
            $ret['songs'] = array();
            foreach($query as $songs){
                if($songs->album_id != $ret['id'])
                        continue;
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

   //     return response()->json(['success' => $query], 200);

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
            ->select( 'songs.*', 'albums.title as album_title', 'albums.id as album_album_id' , 'albums.release_date', 'albums.pic_url', 'artists.name as artist_name', 'artists.id as artist_id')
            ->rightJoin('albums', 'songs.album_id', '=', 'albums.id')
            ->rightJoin('artists', 'artists.id', '=', 'albums.artist_id')
            ->where('albums.id', $id)
            ->orderby('number_of')
            ->get();     

            $ret = array();
            foreach($query as $item){
                $ret['id'] = $item->album_album_id;
                $ret['title'] = $item->album_title;                
                $ret['year'] = $item->release_date;
                $ret['pic_url'] = $item->pic_url;
                $ret['songs'] = array();
                $ret['artist_id'] = $item->artist_id;
                $ret['artist_name'] = $item->artist_name;
                foreach($query as $songs){
                    if($songs->album_id != $ret['id'])
                        continue;
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
       //     $artist['artistid'] = $ret['artist_id'];

       //     return response()->json(['success' => $artist], 200);

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
        if(isset($request->album)){
            $datetime = date("Y-m-d H:i:s");
            DB::table('albums')
                ->where('albums.id', $id)
                ->update(
                    [
                    'title' => $request->album['title'],
                    'release_date' => $request->album['year'],
                    'updated_at' => $datetime
                    ],
                );
                
                    foreach($request->album['songs'] as $song){
                        if(DB::table('songs')
                        ->where([
                            ['songs.album_id', '=', $id],
                            ['songs.id', '=', $song['id']]
                        ])
                        ->update(
                            [
                            'title' => $song['title'],
                            'number_of' => $song['number_of'],
                            'updated_at' => $datetime
                            ],
                        ));
                        else{
                            $datetime = date("Y-m-d H:i:s");                                              
                                DB::table('songs')->insert(
                                    [
                                        'title' => $song['title'],
                                        'number_of' => $song['number_of'],
                                        'album_id' => $id,
                                        'length' =>  7,//$song['song_length'],
                                        'created_at' => $datetime,
                                        'updated_at' => $datetime
                                    ]);                         
                            }       
                        } 
        }
                       
        return response()->json(['success' => 'OK'], 200);
    }

    public function updateSong(Request $request, $id, $number)
    {
        //
        if(isset($request->album)){
            DB::table('albums')
                ->where('albums.id', $id)
                ->update(
                    ['title' => $request->album['title']],
                    ['release_date' => $request->album['title']],
                );
                if(isset($request->album->songs)){
                    foreach($songs as $song){
                        DB::table('songs')
                        ->where([
                            ['songs.album_id', '=', $id],
                            ['songs.id', '=', $song->id]
                        ])
                        ->update(
                            ['title' => $song->title],
                            ['release_date' => $request->album['title']],
                        );
                    }
                }
        }
        return response()->json(['success' => 'OK'], 200);
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
        
        if(DB::table('albums')->where('albums.id', '=', $id)->delete()){
            return response()->json(['success' => 'Ok'], 200);
        }
        
        return response()->json(['error' => 'Error'], 200);
    }

    public function destroySong($id)
    {
        //
        
        if(DB::table('songs')->where('songs.id', '=', $id)->delete()){
            return response()->json(['success' => 'Ok'], 200);
        }
        
        return response()->json(['error' => 'Error'], 200);
    }
}
