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

    <form action="{{ (empty($post->id)) ? route('admin.posts.store') : route('admin.posts.update', $post) }}" method="post">
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

        @foreach ($tags as $tag)
        <div class="form-group form-check d-inline mr-2">
                <input type="checkbox" class="form-check-input" name="tags[]" > 
                {{-- {{ (!empty($post->id) && ) ? '' : '' }} --}}
                <label class="form-check-label" for="tag">{{ $tag->tag }}</label>
            </div>
            @endforeach

        @if (empty($post->id))
            <button type="submit" class="btn btn-primary d-block mt-5">Inserisci nuovo articolo</button>
        @else
            <button type="submit" class="btn btn-primary d-block mt-5">Modifica articolo</button>
        @endif
        

    </form>
</div>
@endsection
