@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mt-5 mb-5">{{ $post['titolo'] }}</h2>
    <p>{{ $post['articolo'] }}</p>
    <small class="text-muted">Pubblicato da {{ $nomeUtente }}</small>
</div>
@endsection
