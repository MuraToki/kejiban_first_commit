@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <!-- メイン -->
        <div class="col-10 col-md-6 offset-1 offset-md-3">
            <div class="card">
                <div class="card-header">
                   {{ $post->id }}
                </div>
                <div class="card-body">
                    <p>naiyou</p>
                    <h1>{{ $post->content }}</h1>
                    <h2>{{ $user->name }}</h2>
                    <a class="btn btn-primary" href="{{ route('home') }}">戻る</a>
                    <a  onclick="location.href='/edit/{{ $post->id }}'" class="btn btn-dark">編集する</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection