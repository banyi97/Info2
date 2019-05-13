@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
    <album-component :palbum="{{$album}}"></album-component>
    </div>
</div>
<br>
@endsection