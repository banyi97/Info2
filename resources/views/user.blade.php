@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <user-component :user='{{$user}}'></user-component>
    </div>
</div>
<br>
@endsection