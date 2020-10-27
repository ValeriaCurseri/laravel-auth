@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row row-cols-1 row-cols-md-3">
        @foreach($posts as $post)
        <div class="col mb-4">
            <div class="card">
                @if(!empty($post['img']))
                    <img src="{{ asset('storage/' . $post['img']) }}" class="img-fluid" alt="{{ $post->titolo }}">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $post->titolo }}</h5>
                    {{-- DA METTERE NELLO SHOW <p class="card-text">{{ $post->articolo }}</p> --}}
                    <p class="card-text"><small class="text-muted">{{ $post->user->name }} / {{ $post->updated_at }}</small></p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

