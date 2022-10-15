@extends('layouts.main')

@section('title', 'Produtos')

@section('content')

<h1>Tela de Produto</h1>

@if($id != null)
    <p>Produto {{ $id }}</p>
@endif

@endsection
