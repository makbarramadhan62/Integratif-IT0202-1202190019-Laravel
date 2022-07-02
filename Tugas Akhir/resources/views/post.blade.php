@extends('layouts.main')

@section('container')
    <div class="row justify-content-center">
        {{-- <div class="col-md-8"> --}}
        <h1 class="mb-3">{{ $post->title }}</h1>

        <p>
            By. <a href="/posts?source={{ $post->source->username }}"
                class="text-decoration-none">{{ $post->source->name }}</a> in
            <a href="/posts?category={{ $post->category }}" class="text-decoration-none">{{ $post->category }}</a>
        </p>
        {{-- <img src="https://source.unsplash.com/1200x500?{{ $post->category }} alt"{{ $post->category }}"
                    class="img-fluid"> --}}

        <article class="my-3 fs-5">
            {!! $post->content !!}
        </article>

        <a href="/posts" class="d-block mt-3 mb-5">Back to Posts</a>
        {{-- </div> --}}
    </div>
@endsection
