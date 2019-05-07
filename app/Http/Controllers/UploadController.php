<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

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
        //    $encoded = base64_encode($path);
        //    DB::table('albums')
        //        ->where('id', $id)
        //        ->update(['pic_url' => $encoded]);
        }
    }

    public function storeArtistPic(Request $request, $id)
    {
        //
        if ($request->file('photo')->isValid()) {
            //
            $path = $request->photo->store('public');
        }
    }

    public function storeSongs(Request $request, $id)
    {
        //
        if ($request->file('photo')->isValid()) {
            //
            $path = $request->photo->store('public');
        }
    }
      
}
