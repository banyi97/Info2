<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeAlbumPic(Request $request, $id)
    {
        //
        $datetime = date("Y-m-d H:i:s");
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
        $datetime = date("Y-m-d H:i:s");
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
        $datetime = date("Y-m-d H:i:s");
        if ($request->song->isValid()) {
            //   
            $path = $request->song->store('public');
            $filename = basename($path);
            DB::table('songs')
                ->where('songs.id', $id)
                ->update([
                    'file_url' => $filename,
                    'updated_at' => date("Y-m-d H:i:s"),
                ]);
        return response()->json(['success' => $filename], 200);
        }
        return response()->json(['success' => 'error'], 400);
    }
    
    public function storeTest(Request $request)
    {
        
        return Storage::url();
        
    }
}
