@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mt-5 mb-5">{{ $post['titolo'] }}</h2>
    <p>{{ $post['articolo'] }}</p>
    <small class="text-muted">Pubblicato da {{ $nomeUtente }}</small>
    
    <form class="mt-5" action="{{ route('admin.posts.destroy', $post->id) }}" method="post">
        @csrf
        @method('DELETE')
        <input class="btn btn-dark mb-5" type="submit" value="Cancella articolo">
    </form>
    <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-dark mb-5">Modifica l'articolo</a>
</div>
@endsection
