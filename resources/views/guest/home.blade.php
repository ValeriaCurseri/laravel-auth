@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card-columns">
        {{-- <div class="card">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
            <h5 class="card-title">Card title that wraps to a new line</h5>
            <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
            </div>
        </div>
        <div class="card p-3">
            <blockquote class="blockquote mb-0 card-body">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
            <footer class="blockquote-footer">
                <small class="text-muted">
                Someone famous in <cite title="Source Title">Source Title</cite>
                </small>
            </footer>
            </blockquote>
        </div>
        <div class="card">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
            </div>
        </div>
        <div class="card bg-primary text-white text-center p-3">
            <blockquote class="blockquote mb-0">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat.</p>
            <footer class="blockquote-footer text-white">
                <small>
                Someone famous in <cite title="Source Title">Source Title</cite>
                </small>
            </footer>
            </blockquote>
        </div>
        <div class="card text-center">
            <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">This card has a regular title and short paragraphy of text below it.</p>
            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
            </div>
        </div>
        <div class="card">
            <img src="..." class="card-img-top" alt="...">
        </div>
        <div class="card p-3 text-right">
            <blockquote class="blockquote mb-0">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
            <footer class="blockquote-footer">
                <small class="text-muted">
                Someone famous in <cite title="Source Title">Source Title</cite>
                </small>
            </footer>
            </blockquote>
        </div> --}}
        @foreach($posts as $post)
        <div class="card">
            <div class="card-body">
            <h5 class="card-title">{{ $post->titolo }}</h5>
            <p class="card-text">{{ $post->articolo }}</p>
            <p class="card-text"><small class="text-muted">Utente {{ $post->user_id }} / {{ $post->updated_at }}</small></p>
            </div>
        </div>
        @endforeach
    </div>
    {{-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div> --}}
</div>
@endsection
