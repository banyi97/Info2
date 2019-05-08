@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <albumadmin-component :ismodify=true :artist="{{$artist}}"></albumadmin-component>
    </div>
</div>
<br>
@endsection