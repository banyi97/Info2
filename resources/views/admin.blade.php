@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <admin-component :users="{{$users}}"></admin-component>
    </div>
</div>
<br>
@endsection