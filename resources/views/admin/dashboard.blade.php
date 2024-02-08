@extends('adminlte::page')

@section('title', 'Painel')

@section('content_header')

    <div class="row">
        <div class="col-md-6">
            <h1>Dashboard</h1>
        </div>
    </div>

@endsection

@section('content')

    <div class="row">
        <div class="col-md-3">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $userCount }}</h3>
                    <p>Usuários</p>
                </div>
                <div class="icon">
                    <i class="far fa-fw fa-user"></i>
                </div>
            </div>
        </div>
    </div>

@endsection

