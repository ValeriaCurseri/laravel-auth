@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mt-5 mb-5">Crea un nuovo utente</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ (empty($user->id)) ? route('admin.users.store') : route('admin.users.update', $user->id) }}" method="post">
        @csrf
        @if (empty($user->id))
            @method('POST')
        @else
            @method('PATCH')
        @endif

        <div class="form-row">

            <div class="form-group col-md-6">
                <label for="name">Nome e cognome</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="es. Mario Rossi" value="{{ (empty($user->id)) ? old('name') : $user->name }}">
            </div>

            <div class="form-group form-check col-md-6 pl-3">
                <span class="d-block">Ruolo</span>
                <div id="ruolo" class="d-flex flex-row align-items-center">
                    @foreach ($roles as $role)
                    <div class="pl-4 pr-4">
                    <input class="form-check-input" type="radio" name="role_id" id="{{ $role->id }}" value="{{ $role->id }}" {{ ( $role->id == $user->role_id) ? 'checked' : '' }} />
                        <label class="form-check-label" for="role_id">
                            {{ $role->nome }}
                        </label>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>

        <div class="form-row">

            <div class="form-group col-md-6">
                <label for="email">Email</label>
                <input type="mail" class="form-control" name="email" id="email" placeholder="es. mario.rossi@mail.com" value="{{ (empty($user->id)) ? old('email') : $user->email }}">
            </div>

            <div class="form-group col-md-6">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" value="{{ (empty($user->id)) ? old('password') : $user->password }}">
            </div>
        
        </div>

        @if (empty($user->id))
            <button type="submit" class="btn btn-primary d-block mt-5">Inserisci nuovo utente</button>
        @else
            <button type="submit" class="btn btn-primary d-block mt-5">Modifica utente</button>
        @endif
        

    </form>
</div>
@endsection
