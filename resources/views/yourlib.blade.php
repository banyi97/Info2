@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    <yourlib-component  :playlists='{{$playlists}}'></yourlib-component>
    </div>
</div>
<br>
@endsection