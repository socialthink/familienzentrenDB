@extends('board.board')

@section('inhalt')
<div class="container">
<h1 class="mt-5">Passwort neu setzen</h1>
<p class="lead">Bitte setze ein neues Passwort.</p>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="mt-4">
              <label for="email" class="form-label">E-Mail</label>
              <input type="email" id="email" name="email" class="form-control" required>
            </div>

            <div class="mt-4">
              <label for="password" class="form-label">Passwort</label>
              <input type="password" id="password" name="password" class="form-control" required autocomplete="new-password">
            </div>

            <div class="mt-4">
              <label for="password" class="form-label">Passwort wiederholen</label>
              <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required autocomplete="new-password">
            </div>
            @if ($errors->any())
            <div class="mt-4">
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
              </div>
            @endif
            @if (session('status'))
            <div class="mt-4">
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                      </div>

            @endif
            <div class="flex items-center justify-end mt-4">
                <button class="btn btn-primary" type="submit">Passwort setzen</button>
            </div>
        </form>

</div>


@endsection
