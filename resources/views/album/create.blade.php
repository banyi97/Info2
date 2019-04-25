@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    <albumadmin-component :artist="{{$artist}}"></albumadmin-component>
    </div>
</div>
<br>
@endsection