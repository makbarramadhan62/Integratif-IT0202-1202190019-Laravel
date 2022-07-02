@extends('layouts/main')

@section('container')
    <h1 class="mb-3 text-center">{{ $title }}</h1>

    <div class="row justify-content-center mb-3">
        <div class="col-md-6">
            <form action="/posts">
                @if (request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                @if (request('author'))
                    <input type="hidden" name="author" value="{{ request('author') }}">
                @endif
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search..." name="search"
                        value="{{ request('search') }}">
                    <button class="btn btn-dark" type="submit">search</button>
                </div>
            </form>
        </div>
    </div>

    @if ($posts->count())
        <div class="card mb-3">
            {{-- <img src="{{ $posts[0]->image->url }}" class="card-img-top" alt="{{ $posts[0]->category }}"> --}}
            <img src="https://source.unsplash.com/1200x500?"" alt="none" class="img-fluid">
            <div class="card-body text-center">
                <p class="card-text">{!! $posts[0]->excerpt !!}</p>
                <h3 class="card-title"><a href="/posts/{{ $posts[0]->title }}"
                        class="text-decoration-none text-dark">{{ $posts[0]->title }}</a></h3>
                <p>
                    <small class="text-muted">
                        By. <a href="/posts?rss={{ $posts[0]->source->username }}"
                            class="text-decoration-none">{{ $posts[0]->source->name }}</a> in <a
                            href="/posts?category={{ $posts[0]->category }}"
                            class="text-decoration-none">{{ $posts[0]->category }}</a>
                        {{ $posts[0]->created_at->diffForHumans() }}
                    </small>
                </p>

                <a href="/posts/{{ $posts[0]->title }}" class="text-decoration-none btn btn-primary">Read More</a>
            </div>
        </div>

        <div class="container">
            <div class="row">
                @foreach ($posts->skip(1) as $post)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="position-absolute px-3 py-2" style="background-color: rgba(0, 0, 0, 0.7)">
                                <a href="/posts?category={{ $post->category }}"
                                    class="text-white text-decoration-none">{{ $post->category }}</a>
                            </div>
                            {{-- <img src="{{ $post->image->url }}" class="card-img-top" alt="{{ $post->title }}"> --}}
                            <img src="https://source.unsplash.com/1200x500" alt="none" class="img-fluid">
                            <p class="card-text justify-conten-center">{!! $post->excerpt !!}</p>
                            <div class="card-body">
                                <h5 class="card-title">{{ $post->title }}</h5>
                                <p>
                                    <small class="text-muted">
                                        By. <a href="/posts?author={{ $post->source->username }}"
                                            class="text-decoration-none">{{ $post->source->name }}</a>
                                        {{ $post->created_at->diffForHumans() }}
                                    </small>
                                </p>
                                <a href="/posts/{{ $post->title }}" class="btn btn-primary">Read More</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <p class="text-center fs-4">Post Not Found.</p>
    @endif

    <div class="d-flex justify-content-center">
        {{ $posts->links() }}
    </div>

@endsection
