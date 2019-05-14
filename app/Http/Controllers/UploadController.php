<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeAlbumPic(Request $request, $id)
    {
        //
        if ($request->file('photo')->isValid()) {
            //
            $path = $request->photo->store('public');
            $filename = basename($path);
            DB::table('albums')
                ->where('albums.id', $id)
                ->update([
                    'pic_url' => $filename,
                    'updated_at' => date("Y-m-d H:i:s"),
                ]);
        return response()->json(['success' => $filename], 200);
        }
    }

    public function storeArtistPic(Request $request, $id)
    {
        //
        if ($request->file('photo')->isValid()) {
            //
            $path = $request->photo->store('public');
            $filename = basename($path);
            DB::table('artists')
                ->where('artists.id', $id)
                ->update([
                    'pic_url' => $filename,
                    'updated_at' => date("Y-m-d H:i:s"),
                ]);
        return response()->json(['success' => $filename], 200);
        }
    }

    public function storeSongs(Request $request, $id)
    {
        //     
        if (true) {
            //   
            $path = $request->songfile->store('public');
            $filename = basename($path);
            DB::table('songs')
                ->where('songs.id', $id)
                ->update([
                    'file_url' => $filename,
                    'updated_at' => date("Y-m-d H:i:s"),
                ]);
        return response()->json(['success' => $filename], 200);
        }
        return response()->json(['success' => $request->song->isValid()], 200);
    }

    public function storePlaylist(Request $request, $id)
    {
        //     
        if ($request->photo->isValid()) {
            //   
            $path = $request->photo->store('public');
            $filename = basename($path);
            DB::table('playlists')
                ->where('playlists.id', $id)
                ->update([
                    'pic_url' => $filename,
                    'updated_at' => date("Y-m-d H:i:s"),
                ]);
        return response()->json(['success' => $filename], 200);
        }
        return response()->json(['success' => 'error'], 400);
    }
    
    public function storeTest(Request $request)
    {
        return response()->json(['status' => $request->album], 200);
        if(isset($request->album)){
            try{
                $path = $request->album->picurl->store('public');
            }
            catch(Exception $e){
                return response()->json(['status' => $e], 200);
            }
        }
        return response()->json(['status' => 'ok'], 200);
        
    }
}
