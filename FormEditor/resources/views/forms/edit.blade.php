@extends('layouts.forms')
@section('main') py-4 displayBuilder @endsection

@section('content')


    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="formDetail">
        <input form="form-builder" type="text" class="input-field mon-shadow @error('title') is-invalid @enderror" name="title" id="title" placeholder="Titre" value="{{ $forms->title }}"/>

        <textarea form="form-builder" class="input-field mon-shadow @error('description') is-invalid @enderror" id="description" name="description" rows="2" placeholder="Description">{{ $forms->description }}</textarea>
        
        <div class="input-field mon-shadow">
            <label for="exampleColorInput">Couleur</label>
            <input form="form-builder" type="color" name="color" id="exampleColorInput" value="{{ $forms->color }}" title="Veuillez choisir une couleur">
        </div>

        <div class="input-field mon-shadow range-slider">
            <label for="formRange">Progression</label>
            <input form="form-builder" id="formRange" name="progress" class="range-slider__range" type="range" value="{{ $forms->progress }}" min="0" max="100">
            <span class="range-slider__value">0</span>
        </div>

        <input form="form-builder" type="datetime-local" class="input-field mon-shadow @error('date') is-invalid @enderror" name="date" id="date" placeholder="Date" value="{{ date('Y-m-d\TH:i', strtotime($forms->date)) }}"/>
    </div>

    <div class="formBuilder">
        <div class="box-left">
            <div data-tpl="header1" data-title="Header 1">
                Label
            </div>
            <div data-tpl="header2" data-title="Header 2">
                Input
            </div>
            <div data-tpl="header3" data-title="Header 3">
                Text Area
            </div>
            <div data-tpl="checkbox" data-title="Checkbox">
                CheckBox
            </div>
            <div data-tpl="checkbox-check" data-title="Checkbox Checked">
                CheckBox Checked
            </div>
            {{-- <div data-tpl="shortparagraph" data-title="Short paragraph">
                Select Box
            </div> --}}
            <div data-tpl="image">
                Select Image
            </div>
        </div>
        <div class="box-right">
            <div class="right"><span style="color: #fff">Double-click : Supprimer un champs</span></div>
            <form id="form-builder" action="{{ url('forms', $forms->id) }}" method="POST" enctype='multipart/form-data'>
            @csrf
            @method('PUT')

                @if(session()->has('message'))
                    <div class="alert alert-success close-message">
                        {{ session()->get('message') }}
                    </div>
                @endif

                <input type="hidden" id="form-data" name="formulaire" value="">
                <div class="box-rightsave @error('formulaire') is-invalid @enderror" id="contents-2" style="min-height: 150px" name="formulaire" id="formulaire">
                <?php
                $formChaine = substr($forms->formulaire ,1, -1);
                // $sortie = preg_replace("#(?<!\\\)d#", ' ', $formChaine);
                $sortie =  str_replace('\\', '', $formChaine);
                // while le premier caractère n'est pas un < efface le premier caractère
                if(strlen($sortie)>5){
                    $sortie = substr($sortie, strpos($sortie, "<")) ;    
                }
                echo $sortie;
                ?>
                </div>
                
            </form>
        </div>
    </div>
    <div class="options bg-center" style="float: right">
        <button class="cancel btn-danger"><a class="cancel2" href="{{ url('forms') }}"> Annuler </a></button>
        <button class="reset">Effacer</button>
        <button class="save">Télécharger en PDF</button>
        <button class="form-submit" onclick ="replacePlaceholderByValue(); event.preventDefault();
      document.getElementById('form-builder').submit();">Enregistrer</button>
    </div>
@endsection