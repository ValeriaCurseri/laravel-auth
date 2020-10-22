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

    <form action="{{route('admin.posts.store')}}" method="post">
    @csrf
    @method('POST')

    <div class="form-row">
        <div class="form-group col-md-2">
            <label for="user_id">ID Autore</label>
            <select id="user_id" name="user_id" class="form-control">
                <option> </option>
                @foreach($users as $user)
                <option>{{ $user->id }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group col-md-10">
            <label for="titolo">Titolo articolo</label>
            <input type="text" class="form-control" name="titolo" id="titolo" placeholder="Titolo">
        </div>

    </div>

    <div class="form-group">
        <label for="articolo">Articolo</label>
        <textarea class="form-control" name="articolo" id="articolo" placeholder="Scrivi qui il tuo articolo"></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Inserisci nuovo articolo</button>

    </form>
</div>
@endsection
