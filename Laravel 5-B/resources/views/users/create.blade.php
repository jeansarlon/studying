@extends('layouts.app')

@section('content')
    <h1>Criar novo usuário</h1>
    @include('partials.alerts')
    {{ Form::open(['route' => 'users.store']) }}
        @include('users.partials.form')
        <button class="btn btn-primary" type="submit">Salvar</button>
        <a href="{{ route('users.index') }}" class="btn btn-default btn-xs">Voltar</a>
    {{ Form::close() }}
@stop