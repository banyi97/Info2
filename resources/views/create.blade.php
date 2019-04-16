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
                    Add page
                    <form action="/admin/store" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="pic">
                        <button type="submit">Upload</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
@endsection