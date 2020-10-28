@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mt-5 mb-5">Crea un nuovo articolo</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form enctype="multipart/form-data" action="{{ (empty($post->id)) ? route('admin.posts.store') : route('admin.posts.update', $post) }}" method="post">
        @csrf
        @if (empty($post->id))
            @method('POST')
        @else
            @method('PATCH')
        @endif

        <div class="form-group">
            <label for="titolo">Titolo</label>
            <input type="text" class="form-control" name="titolo" id="titolo" placeholder="Titolo" value="{{ (empty($post->id)) ? old('titolo') : $post->titolo }}">
        </div>

        <div class="form-group">
            <label for="articolo">Articolo</label>
            <textarea class="form-control" name="articolo" id="articolo" placeholder="Scrivi qui il tuo articolo">{{ (empty($post->id)) ? old('articolo') : $post->articolo }}</textarea>
        </div>

        <div class="form-group">
            <label for="img">Copertina dell'articolo</label>
            @if (!empty($post->img))
                <img class="d-block mb-2 mt-2" src="{{ asset('storage/' . $post->img) }}" alt="{{ $post->slug }}">
            @endif
            <input type="file" class="form-control-file" id="img" name="img" accept="image/*">
        </div>

        <div class="form-group form-check">
            @foreach ($tags as $tag)
            <div class="pr-4 d-inline">
                <label for="tag" class="form-check-label mr-4">{{ $tag->tag }}</label>
                <input type="checkbox" name="tags[]" class="form-check-input" value="{{ $tag->id }}" {{(!empty($post->id) && $post->tags->contains($tag->id)) ? 'checked' : '' }}> 
            </div>
            @endforeach
        </div>

        @if (empty($post->id))
            <button type="submit" class="btn btn-primary d-block mt-5">Inserisci nuovo articolo</button>
        @else
            <button type="submit" class="btn btn-primary d-block mt-5">Modifica articolo</button>
        @endif
        

    </form>
</div>
@endsection
