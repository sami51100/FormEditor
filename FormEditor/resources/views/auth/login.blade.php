@extends('layouts.auth')

@section('error')
    @if($errors->any())
        <!-- ErrorMessageBanner -->
        <div class="alert showAlert">
            <span class="fas fa-exclamation-circle"></span>
            <span class="msg">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach    
            </span>
            <div class="close-btn">
                <span class="fas fa-times"></span>
            </div>
        </div>
    @endif
@endsection

@section('content')
<!-- Se connecter -->
<form method="POST" action="{{ route('login') }}" class="sign-in-form">
@csrf
    <div class="centred">
        <img class="left-flex" src=" {{ asset('img/FormEditor.png') }} " style="width: 50px"/>
        <h2 class="title">Se connecter</h2>
    </div>

    <div class="input-field mon-shadow">
      <i class="fas fa-user"></i>
      <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email" autofocus>

    </div>

    <div class="input-field mon-shadow">
      <i class="fas fa-lock"></i>
      <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Mot de passe"/>

    </div>

    <div class="form-group row">
        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

        <label class="form-check-label" for="remember">
            {{ __('Se souvenir de moi') }}
        </label>
    </div>

    <div class="form-group row mb-0">
        <div class="col-md-8 offset-md-4">
            <button type="submit" class="btn solid btn_alert">
                {{ __("Se connecter") }}
            </button>

        </div>
    </div>

    @if (Route::has('password.request'))
                <a class="social-text" href="{{ route('password.request') }}">
                    {{ __('Mot de passe oublié ?') }}
                </a>
    @endif
    
  </form>
@endsection
