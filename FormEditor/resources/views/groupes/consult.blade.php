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
    <div class="mb-4 GroupeInfo">
        <div class="GroupeInfo-left">
      <img style="border-radius: 20px;" src="{{ $groupe->logo }}">
        </div>
        <div class="GroupeInfo-right">
      <h3 class="font-medium text-xl sm:text-2xl">{{ $groupe->title }}</h3>
        <p class="mt-2 text-gray-500 text-sm sm:text-base">{{ $groupe->description }}</p>
     </div>
    </div>
    
    <div class="text-gray-500 mt-2 text-sm sm:text-base">
      Membre(s) du groupe :
    </div>
    
    <div class="mt-2 flex items-center justify-between flex-wrap w-full">
      <div>
        <div class="flex -space-x-2 overflow-hidden">
  <?php $compteurMembre=0; ?>
  @foreach ($groupe->usersGroupe->sortBy('id') as $member)
    <img class="inline-block h-10 w-10 rounded-full ring-2 ring-white" src="{{$member->profile_photo_path}}" alt="">
  <?php $compteurMembre++; ?>
  @endforeach
</div>
      </div>
      <div class="sm:mt-0 mt-4 w-full sm:w-auto">
        @if($compteurMembre<6)
        <a class="px-6 py-2 bg-green-500 text-white rounded w-full sm:w-auto text-decoration-none" href="{{ route('groupes.create', $groupe->id) }}">Ajouter un Membre</a>
        @endif
        <a class="px-6 py-2 bg-indigo-500 text-white rounded w-full sm:w-auto text-decoration-none" href="{{ route('groupes.edit', $groupe->id) }}">Editer Groupe</a>

        <form id="delete-form{{$groupe->id}}" action="{{ route('forms.destroy', $groupe->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Etes-vous sûr de vouloir supprimer votre Groupe/Formulaire ?');">
        @method('DELETE')
        @csrf
        <button class="px-6 py-2 bg-red-500 text-white rounded w-full sm:w-auto text-decoration-none" type="submit" value="Delete">Supprimer Groupe/Formulaire</button>
      </form>
      </div>
    </div>
  </div>

          <!-- Liste des membres :   -->
          <table class="w-full text-left">
            <thead>
              <tr class="text-gray-400">
                <th class="font-normal px-3 pt-0 pb-3 border-b border-gray-200 dark:border-gray-800"></th>
                <th class="font-normal px-3 pt-0 pb-3 border-b border-gray-200 dark:border-gray-800">Nom</th>
                <th class="font-normal px-3 pt-0 pb-3 border-b border-gray-200 dark:border-gray-800">Prénom</th>
                <th class="font-normal px-3 pt-0 pb-3 border-b border-gray-200 dark:border-gray-800 hidden md:table-cell">Email</th>
                <th class="font-normal px-3 pt-0 pb-3 border-b border-gray-200 dark:border-gray-800">Role</th>
                <th class="font-normal px-3 pt-0 pb-3 border-b border-gray-200 dark:border-gray-800"></th>
              </tr>
            </thead>
            <tbody class="text-gray-600 dark:text-gray-100">
              @foreach ($groupe->usersGroupe->sortBy('id') as $member)
              @if ($member->id != Auth::id())
              <tr>
                <td class="sm:p-3 py-2 px-1 border-b border-gray-200 dark:border-gray-800 px-6 text-sm profile">
                  {{-- <img src=" {{ $user->profile_photo_path }} "> --}}
                  <img src=" {{$member->profile_photo_path}} ">
                </td>
                <td class="sm:p-3 py-2 px-3 border-b border-gray-200 dark:border-gray-800">
                  <div class="flex items-center">
                    {{$member->lastname}}
                  </div>
                </td>
                <td class="sm:p-3 py-2 px-3 border-b border-gray-200 dark:border-gray-800">
                  <div class="flex items-center">
                    {{$member->firstname}}
                  </div>
                </td>
                <td class="sm:p-3 py-2 px-3 border-b border-gray-200 dark:border-gray-800 md:table-cell hidden">
                  <div class="flex items-center">
                    {{$member->email}}
                  </div>
                </td>
                <td class="sm:p-3 py-2 px-3 border-b border-gray-200 dark:border-gray-800 md:table-cell hidden">
                  <div class="flex items-center">
                    {{$member->role->role_nom}}
                  </div>
                </td>
                <td class="sm:p-3 py-2 px-5 border-b border-gray-200 dark:border-gray-800 text-red-500">
                  <form id="delete-user{{$member->id}} " class="inline-block" action=" {{ route('groupes.destroy', $member->id) }} " method="POST" onsubmit="return confirm('Etes-vous sûr de vouloir retirer ce membre du groupe ?');">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit" id="red" class="btn btn-sm btn-outline-danger mb-1 button-glow" value="Delete">Retirer du groupe</button>
                  </form>
                </td>
              </tr>
              @endif
              @endforeach
            </tbody>
          </table>

@endsection