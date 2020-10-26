@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mt-5 mb-5">{{ $post['titolo'] }}</h2>
    <img src="{{ $post['img'] }}" class="img-fluid" alt="Responsive image">
    <p>{{ $post['articolo'] }}</p>
    <small class="d-block mb-5">Pubblicato da {{ $nomeUtente }}</small>
    <small class="d-block mb-5 text-muted"><strong>Tag</strong> 
        @foreach($tags as $tag)
        {{ $tag->tag }}
        @endforeach
    </small>
    
    <form class="d-inline mr-5" action="{{ route('admin.posts.destroy', $post->id) }}" method="post">
        @csrf
        @method('DELETE')
        <input class="btn btn-dark mb-5" type="submit" value="Cancella articolo">
    </form>
    <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-dark mb-5">Modifica l'articolo</a>
</div>
@endsection
