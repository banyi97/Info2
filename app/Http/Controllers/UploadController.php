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
        if ($request->file('photo')->isValid()) {
            //
            $path = $request->photo->store('public');
            $filename = basename($path);
            DB::table('albums')
                ->where('albums.id', $id)
                ->update(['pic_url' => $filename]);
        return response()->json(['success' => $filename], 200);
        }
    }

    public function storeArtistPic(Request $request, $id)
    {
        //
        $path = $request->photo->store('public');
            DB::table('artists')
                ->where('id', $id)
                ->update(['pic_url' => $filename]);
        return response()->json(['success' => basename($path)], 200);
    }

    public function storeSongs(Request $request, $id)
    {
        //
        if ($request->file('photo')->isValid()) {
            //
            $path = $request->photo->store('public');
        }
    }
    
    public function storeTest(Request $request)
    {
        
        return Storage::url();
        
    }
}
