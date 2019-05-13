@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <album-component :playlistview=true :palbum='{{$playlist}}'></album-component>
    </div>
</div>
<br>
@endsection