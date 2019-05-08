@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if($mode==='create')
            <artistadmin-component met='create'></artistadmin-component>
        @else
            <artistadmin-component met='modify'></artistadmin-component>
        @endif
    </div>
</div>
<br>
@endsection