@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mt-5 mb-5">Gestisci gli articoli</h2>
    <a href="{{ route('posts.create') }}" class="btn btn-dark mb-5">Crea nuovo articolo</a>
    {{-- @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif --}}
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">ID Autore</th>
                <th scope="col">Titolo</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            {{-- @foreach($posts as $post)
            <tr>
                <th scope="row">{{ $post->id }}</th>
                <td>{{ $post->user_id }}</td>
                <td>{{ $post->titolo }}</td>
                <td>
                    <a href="{{ route('posts.show', $post->id) }}" class="btn btn-dark mb-5">Mostra dettagli articolo</a>
                </td>
            </tr>
            @endforeach --}}
        </tbody>
    </table>
</div>
@endsection
{{-- .Xn*2Amv7G2nH!9 --}}