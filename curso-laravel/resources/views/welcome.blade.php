@extends('layouts.main')

@section('title', 'Diaszano Eventos')
@section('content')

<h1>Algum título</h1>
<img src='/img/banner.jpg' alt='Banner'>

@if(10<5)
    <p>A condição é true</p>
@endif

@foreach($nomes as $nome)
    <p>{{ $loop->index }} - {{ $nome }}</p>
@endforeach

@for($i = 0; $i < count($arr); $i++)
    <p>{{ $arr[$i] }}</p>
@endfor

<p>{{ $nome }}</p>

@endsection
