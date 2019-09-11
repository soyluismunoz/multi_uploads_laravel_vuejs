@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <create-post></create-post>
        </div>
        <div class="col-md-6 post-container" style="height: 35em; overflow-y: scroll;">
            <all-posts> </all-posts>
        </div>
    </div>
</div>
@endsection
