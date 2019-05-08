@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <artistadmin-component met='modify' :partist='{{$artist}}'></artistadmin-component>
    </div>
</div>
<br>
@endsection