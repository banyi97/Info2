@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if($mode==='create')
            <artistadmin-component></artistadmin-component>
        @else
            <artistadmin-component></artistadmin-component>
        @endif
    </div>
</div>
<br>
@endsection