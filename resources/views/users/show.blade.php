@extends('layout')

@section('title','Usuario {{ $user->name }}')

@section('content')

	<h1>Usuario # {{ $user->id }}</h1>

	Mostrando el detalle del usuario: {{ $user->email }}
@endsection