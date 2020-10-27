@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mt-5 mb-5">Gestisci gli articoli</h2>
    <a href="{{ route('admin.posts.create') }}" class="btn btn-dark mb-5">Crea nuovo articolo</a>
    
    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">ID Autore</th>
                <th scope="col">Copertina</th>
                <th scope="col">Titolo</th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
            <tr>
                <th scope="row">{{ $post->id }}</th>
                <td>{{ $post->user_id }}</td>
                <td>
                    @if(!empty($post->img))
                        <img src="{{ asset('storage/' . $post->img) }}" class="img-fluid" alt="{{ $post->titolo }}">
                    @endif
                </td>
                <td>{{ $post->titolo }}</td>
                <td>
                    <a href="{{ route('admin.posts.show', $post->id) }}" class="btn btn-dark mb-5">Mostra dettagli articolo</a>
                </td>
                <td>
                    <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-dark mb-5">Modifica l'articolo</a>
                </td>
                <td>
                    <form action="{{ route('admin.posts.destroy', $post->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <input class="btn btn-dark mb-5" type="submit" value="Cancella articolo">
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="pagination d-flex justify-content-center">
        {{ $posts->links() }}
    </div>
</div>
@endsection
{{-- .Xn*2Amv7G2nH!9 --}}