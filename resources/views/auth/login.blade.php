@extends('board.board')

@section('inhalt')
<div class="container">
<h1 class="mt-5">Login</h1>
<p class="lead">Hier findest du die wichtigsten Übersichtsdaten.</p>
@if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mt-4">
              <label for="email" class="form-label">E-Mail</label>
              <input type="email" id="email" name="email" class="form-control">
            </div>

            <div class="mt-4">
              <label for="password" class="form-label">Passwort</label>
              <input type="password" id="password" name="password" class="form-control">
            </div>

            <div class="mt-4">
              <input class="form-check-input" type="checkbox" value="" id="remember_me" name="remember">
              <label class="form-check-label"  for="remember_me">
                Erinnere mich</label>
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
            <div class="flex items-center justify-end mt-4">
                <button class="btn btn-primary" type="submit">Login</button>
                @if (Route::has('password.request'))
              &nbsp;&nbsp;&nbsp;<a href="{{ route('password.request') }}">Passwort vergessen?</a>
                @endif
            </div>
        </form>

</div>


@endsection
