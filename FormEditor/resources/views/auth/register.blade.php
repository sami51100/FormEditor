@extends('layouts.auth')
@section('mode') sign-up-mode @endsection

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
<!-- S'inscrire -->
<form method="POST" action="{{ route('register') }}" class="sign-up-form">
@csrf
    <div class="centred">
    <img class="left-flex" src=" {{ asset('img/FormEditor.png') }} " style="width: 50px"/>
    <h2 class="title">S'inscrire</h2>
    </div>

    {{-- <input type="file" name="profile_photo_path" data-max-file-size="1M"/>
    <p class="text-muted text-center mt-2 mb-0">Max File size 1Mo</p>
    <p class="text-muted">Only Format: JPG,GIF,PNG.</p> --}}

    <div class="input-field mon-shadow">
        <i class="fas fa-user"></i>
        <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname" placeholder="Nom" autofocus/>

    </div>
    
    <div class="input-field mon-shadow">
        <i class="fas fa-user"></i>
        <input id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" required autocomplete="firstname" placeholder="Prénom"/>

    </div>

    <div class="input-field mon-shadow">
        <i class="fas fa-envelope"></i>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email"/>

    </div>
    
    <div class="input-field mon-shadow">
        <i class="fas fa-lock"></i>
        <input id="password-field" id="password" type="password" class="input" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Mot de passe"/>

        <div class="icon-wrapper">
            <span toggle="#password-field" class="ion ion-eye field-icon toggle-password"></span>
        </div>

        <div class="strength-lines">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
    </div>
    
    <div class="input-field mon-shadow">
        <i class="fas fa-lock"></i>
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirmer votre Mot de Passe"/>
    </div>

    <div class="centred" style="align-items: center;">
        <label for="role_confirm" class="left-flex">{{ __('Votre Statut : ') }}</label>
        <div class="col-md-6">
            <select class="input-field mon-shadow" name="role_id">
                <option value={{DB::table('roles')->where('role_nom', 'Etudiant')->value('id')}}>Etudiant</option>
                <option value={{DB::table('roles')->where('role_nom', 'Professionnel')->value('id')}}>Professionnel</option>
                <option value={{DB::table('roles')->where('role_nom', 'Particulier')->value('id')}}>Particulier</option>
            </select>
        </div>
    </div>
    
    <div class="form-group row mb-0">
        <div class="col-md-8 offset-md-4">
            <button type="submit" class="btn solid btn_alert">
                {{ __("S'inscrire") }}
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