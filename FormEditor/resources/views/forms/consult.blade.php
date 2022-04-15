@extends('layouts.app')
@section('content-title') Affichage d'un formulaire @endsection
@section('content')
<i>{{ strftime('%d/%m/%Y', strtotime($forms->date)) }}</i>
<strong>{{ $forms->title }}</strong>
{{ $forms->description }}<br/>

<em>par {{ $forms->user->firstname }}</em><br/>

<a href="{{ url('forms/') }}">Retour à la liste</a>
@endsection