@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <artist-component :artist='{{$artist}}'></artist-component>
    </div>
</div>
<br>
@endsection