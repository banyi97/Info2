@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    <admin-component :users="{{$users}}" :artists="{{$artists}}" :albums="{{$albums}}"></admin-component>
    </div>
</div>
<br>
@endsection