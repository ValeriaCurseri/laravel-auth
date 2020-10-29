@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mt-5 mb-5">Gestisci gli utenti</h2>
    <a href="{{ route('admin.users.create') }}" class="btn btn-dark mb-5">Crea nuovo utente</a>
    
    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nome e cognome</th>
                <th scope="col">Ruolo</th>
                <th scope="col">Email</th>
                <th scope="col">Password</th>
                <th scope="col">Creato il</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td class="align-middle" scope="row">{{ $user->name }}</td>
                <td class="align-middle">{{ $user->role->nome }}</td>
                <td class="align-middle">{{ $user->email }}</td>
                <td class="align-middle">{{ $user->password }}</td>
                <td class="align-middle">{{ $user->created_at }}</td>
                <td class="align-middle">
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-dark">Modifica l'utente</a>
                </td>
                <td class="align-middle">
                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <input class="btn btn-dark" type="submit" value="Cancella utente">
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="pagination d-flex justify-content-center">
        {{ $users->links() }}
    </div>
</div>
@endsection
{{-- .Xn*2Amv7G2nH!9 --}}