@extends('board.board')

@section('inhalt')
<div class="container">
<h1 class="mt-5">Passwort neu setzen</h1>
<p class="lead">Bitte die zum Account gehörige E-Mail-Adresse eingeben.</p>

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="mt-4">
              <label for="email" class="form-label">E-Mail</label>
              <input type="email" id="email" name="email" class="form-control" required>
            </div>
            @if (session('status'))
            <div class="mt-4">
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                      </div>

            @endif
            <div class="flex items-center justify-end mt-4">
                <button class="btn btn-primary" type="submit">Passwort vergessen</button>
            </div>
        </form>

</div>


@endsection
