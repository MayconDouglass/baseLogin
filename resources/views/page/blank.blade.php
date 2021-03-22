@extends('template.template')

@section('title', 'Home')

@section('content')

    <div class="d-sm-flex justify-content-between align-items-center mb-4">
        <h3 class="text-dark mb-0">Cadastro</h3>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="/">Início</a></li>
            <li class="breadcrumb-item"><b>Cadastro: Usuários</b></li>
        </ul>
    </div>

    <div class="card shadow">
        <div class="card-header py-3">
            <button type="button" class="btn btn-primario fa fa-user-plus" data-toggle="modal" data-target="#CadastroModal">
                Cadastrar</button>
        </div>
        <div class="card-body">

        </div>

    @endsection

    @section('js')
        <script src="{{ url('/') }}/js/page.js"></script>
        <script src="{{ url('/') }}/js/datatables/jquery.dataTables.js"></script>
    @endsection
