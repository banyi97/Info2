<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class YourLibController extends Controller
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
        $playlists = array();
        $playlists['playlist'] = array();
        $user = Auth::user();
        $query = DB::table('playlists')
            ->select('playlists.id', 'playlists.name', 'playlists.pic_url')      
            ->where('playlists.user_id', $user->id)
            ->get();  
        foreach($query as $playlist){
            $element = array();
            $element['id'] = $playlist->id;
            $element['name'] = $playlist->name;
            $element['pic_url'] = $playlist->pic_url;
            $playlists['playlist'][] = $element; 
        }
        return response()->json(['playlists' => $playlists], 200);      
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
        if(isset($request->playlist)){   
                $user = Auth::user();      
                $id = DB::table('playlists')->insertGetId(
                [
                    'name' => $request->playlist,
                    'user_id' => $user->id,
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                ]
            );    
            return response()->json(['id' => $id, 'name' => $request->playlist, 'pic_url' => 'nopic.png'], 200);                
        }
        return response()->json(['error' => 'ERROR'], 400);
    }
    public function storeElemtent(Request $request)
    {
        //
        if(isset($request->playlistElement)){   
                $elements = DB::table('playlist_elements')->select('playlist_elements.number_of')
                    ->where('playlist_elements.playlist_id',$request->playlistElement['playlistId'])
                    ->get();
                $numer_of = 1;
                foreach($elements as $element){
                    if($numer_of < $element->number_of){
                        $numer_of = $element->number_of + 1;
                    }
                }
                $id = DB::table('playlist_elements')->insertGetId(
                [
                    'playlist_id' => $request->playlistElement['playlistId'],
                    'song_id' => $request->playlistElement['songId'],
                    'number_of' => $numer_of,
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                ]
            );    
            return response()->json(['success' => 'ok'], 200);                
        }
        return response()->json(['error' => 'ERROR'], 400);
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
        $playlist = array();

        $query = DB::table('playlists')
            ->select(
                'playlists.id', 'playlists.name', 'playlists.pic_url', 
                'playlist_elements.id as element_id', 'playlist_elements.song_id as element_song_id', 'playlist_elements.number_of as element_number_of', 'playlist_elements.created_at as element_created',
                'songs.title as song_title', 'songs.file_url as song_file', 'songs.length as song_legth',
                'albums.title as album_title', 'albums.id as album_id',
                'artists.name as artist_name', 'artists.id as artist_id'
                )      
            ->leftJoin('playlist_elements', 'playlist_elements.playlist_id', '=', 'playlists.id')
            ->leftJoin('songs', 'playlist_elements.song_id', '=', 'songs.id')
            ->leftJoin('albums', 'songs.album_id', '=', 'albums.id')
            ->leftJoin('artists', 'albums.artist_id', '=', 'artists.id')
            ->where('playlists.id', $id)
            ->orderby('playlist_elements.playlist_id')
            ->orderby('playlist_elements.number_of')
            ->get();  

        foreach($query as $datas){
            $element = array();
            $playlist['id'] = $datas->id;
            $playlist['title'] = $datas->name; //name
            $playlist['pic_url'] = $datas->pic_url; 
            $playlist['songs'] = array();
            foreach($query as $songs){
                if(!$songs->element_id){
                    continue;
                }
                $song = array();
                $song['id'] = $songs->element_id;
                $song['number_of'] = $songs->element_number_of;
                $song['title'] = $songs->song_title;
                $song['url'] = $songs->song_file;
                $song['album_title'] = $songs->album_title;
                $song['album_id'] = $songs->album_id;
                $song['artist_name'] = $songs->artist_name;
                $song['artist_id'] = $songs->artist_id;
                $song['element_created'] = $songs->element_created;
                $song['song_length'] = $songs->song_legth;
                $playlist['songs'][] = $song;
            }
            break;
        }
    //    return response()->json(['success' => $playlist], 200); 
        return view('playlist')->with([
            'playlist'=> json_encode( $playlist )
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        if(DB::table('playlists')->where('playlists.id', $id)->delete()){
            return response()->json(['success' => 'Ok'], 200);
        }
        
        return response()->json(['error' => 'Error'], 400);
    }

    public function destroyElement($id)
    {
        //
        if(DB::table('playlist_elements')->where('playlist_elements.id', $id)->delete()){
            return response()->json(['success' => 'Ok'], 200);
        }
        
        return response()->json(['error' => 'Error'], 400);
    }
}
