@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!

                </div>
            </div>
        </div>
    </div>
</div>
<br>
{{$name}} <br>
{{$names}}<br>
{{$albums}}<br>
@json($albums)
<test-component prop-message="{{$name}}" :prop-messages="{{$names}}" :albums="{{$albums}}"></test-component>

<album-component :album="{{$album}}"></album-component>

<album-component :artist="{{$artist}}"></album-component>

<artist-component :artist="{{$artist}}"></artist-component>

@endsection
