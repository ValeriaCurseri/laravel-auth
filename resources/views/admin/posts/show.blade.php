@extends('layouts.app')

@section('content')
<div class="container">

    <a class="btn btn-light mb-3 mt-3" href="{{ route('admin.posts.index') }}">
        Torna a tutti gli articoli
    </a>

    <h2 class="mt-5 mb-5">{{ $post['titolo'] }}</h2>
    @if(!empty($post['img']))
        <img src="{{ asset('storage/' . $post['img']) }}" class="img-fluid" alt="Responsive image">
    @endif
    <p class="mt-5">{{ $post['articolo'] }}</p>
    <small class="d-block mb-5">Pubblicato da {{ $nomeUtente }} {{ Carbon\Carbon::parse($post->updated_at)->diffForHumans()}}</small>
    <small class="d-block mb-5 text-muted"><strong>Tag</strong> 
        @foreach($tags as $tag)
        {{ $tag->tag }}
        @endforeach
    </small>
    
    @if(Auth::check())
        <form class="d-inline mr-5" action="{{ route('admin.posts.destroy', $post->id) }}" method="post">
            @csrf
            @method('DELETE')
            <input class="btn btn-dark mb-5" type="submit" value="Cancella articolo">
        </form>
        <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-dark mb-5">Modifica l'articolo</a>
    @endif
</div>
@endsection
