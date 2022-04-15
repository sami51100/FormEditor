@extends('groupes.list')
@section('main') groupe-section mon-shadow @endsection
@section('groupeCSS')
<link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.1.1/tailwind.min.css" rel="stylesheet">
<link href="{{ asset('css/groupe.css') }}" rel="stylesheet">
@endsection

@section('ShowMessage')
@if(session()->has('message'))
        <div class="alert showAlert close-message">
            <span class="fas fa-exclamation-circle"></span>
            <span class="msg">
                {{ session()->get('message') }}
            </span>
            <div class="close-btn">
                <span class="fas fa-times"></span>
            </div>
        </div>
@endif
@endsection

@section('error')
    @if($errors->any())
        <!-- ErrorMessageBanner -->
        <div class="alert showAlert close-message">
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
@section('GroupeInfo')

<!-- Formulaire et Groupe : -->
    <div class="bg-white border border-gray-200 w-full p-4 mb-4">
                <form method="POST" action="{{ route('groupes.addMember', $forms->id) }}">
                    @csrf

                        <div class="form-floating mb-2">
                            <input type="text" name="membreEmail" id="membreEmail" value="" class="form-control" id="floatMembreEmail" placeholder="exemple@formeditor.com">
                            <label   for="floatMembreEmail">Entrez le mail du membre</label>
                        </div>
                        @error('membreEmail')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        
                        
                        <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <a href="{{ URL::previous() }}" class="bg-red-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                Annuler
                            </a>
                            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                Ajouter
                            </button>
                        </div>
                </form>

    </div>
      
@endsection