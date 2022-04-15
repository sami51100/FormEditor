@extends('layouts.forms')
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

@section('content')
    
<div class="bg-gray-100 dark:bg-gray-900 dark:text-white text-gray-600 h-screen flex overflow-hidden text-sm">
  
  <div class="flex-grow overflow-hidden h-full flex flex-col">
    
    <div class="flex-grow flex overflow-x-hidden">
      <div class="xl:w-72 w-48 flex-shrink-0 border-r border-gray-200 dark:border-gray-800 h-full overflow-y-auto lg:block hidden groupe-left">
        <div class="text-xs text-gray-400 tracking-wider">Groupe :</div>
        <div class="relative mt-2">
          <input type="text" class="pl-8 h-9 bg-transparent border border-gray-300 dark:border-gray-700 dark:text-white w-full rounded-md text-sm" placeholder="Search">
          <svg viewBox="0 0 24 24" class="w-4 absolute text-gray-400 top-1/2 transform translate-x-0.5 -translate-y-1/2 left-2" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11" cy="11" r="8"></circle>
            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
          </svg>
        </div>
        <div class="space-y-4 mt-3">
          {{-- Liste des groupes --}}
	        @foreach($formsList as $forms)
          <form action="{{ route('groupes.show', $forms->id) }}">
          @csrf
          <button type="submit" class="bg-white p-3 w-full flex flex-col rounded-md dark:bg-gray-800 shadow">
            <div class="flex xl:flex-row flex-col items-center font-medium text-gray-900 dark:text-white pb-2 mb-2 xl:border-b border-gray-200 border-opacity-75 dark:border-gray-700 w-full">
              <img src=" {{ $forms->logo }} " class="w-7 h-7 mr-2 rounded-full" alt="profile">
              {{ $forms->title }}
            </div>
            <div class="flex items-center w-full">
              <div class="text-xs py-1 px-2 leading-none dark:bg-gray-900 bg-blue-100 text-blue-500 rounded-md"> 
                
                
<?php $compteurMembre=0; ?>
@foreach($forms->usersGroupe as $userGroupe)
  @if($loop->first)
    <b>membre(s) : </b>
  @endif
<?php $compteurMembre++ ?>
@endforeach
{{ $compteurMembre }}

               </div> <!-- count nbr membre -->
              <div class="ml-auto text-xs text-gray-500"> {{ strftime('%d/%m/%Y', strtotime($forms->date)) }} </div>
            </div>
          </a>
          </button>
          </form>
          @endforeach
        </div>
      </div>
      <div class="flex-grow bg-white dark:bg-gray-900 overflow-y-auto">

        <div class="sm:px-7 sm:pt-7 px-4 pt-4 flex flex-col w-full border-b border-gray-200 bg-white dark:bg-gray-900 dark:text-white dark:border-gray-800 sticky top-0">
          <div class="flex w-full items-center">
            <div class="flex items-center text-3xl text-gray-900 dark:text-white mb-4">
              <span>Gestion de vos Groupes</span>
            </div>
            <div class="ml-auto sm:flex hidden items-center justify-end">
              <div class="text-right">
                <div class="text-gray-900 text-lg dark:text-white">Admin > Groupe</div>
              </div>
              <button class="w-8 h-8 ml-4 text-gray-400 shadow dark:text-gray-400 rounded-full flex items-center justify-center border border-gray-200 dark:border-gray-700">
                <svg viewBox="0 0 24 24" class="w-4" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <circle cx="12" cy="12" r="1"></circle>
                  <circle cx="19" cy="12" r="1"></circle>
                  <circle cx="5" cy="12" r="1"></circle>
                </svg>
              </button>
            </div>
          </div>

        </div>
        <div class="sm:p-7 p-4">

          @hasSection('GroupeInfo')
            @yield('GroupeInfo')
          @else
            <div>Veuillez sélectionner un formulaire pour pouvoir afficher toutes ses informations.</div>
          @endif
          
        </div>
      </div>
    </div>
  </div>
</div>

@endsection