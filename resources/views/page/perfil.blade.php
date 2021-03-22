@extends('template.template')

@section('title', 'Cargos')
@section('css')
    <link rel="stylesheet" href="{{ url('/') }}/js/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
@endsection
@section('content')

    <div class="d-sm-flex justify-content-between align-items-center mb-4">
        <h3 class="text-dark mb-0">Cargos</h3>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="/">Início</a></li>
            <li class="breadcrumb-item">Usuários</li>
            <li class="breadcrumb-item"><b>Cadastro: Cargos</b></li>
        </ul>
    </div>


    <div class="alert alert-success alert-dismissible d-none" id="div_status">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <i class="icon fa fa-check"></i> Registro Salvo/Atualizado!
    </div>

    <div class="alert alert-info alert-dismissible d-none" id="div_status_reset">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <i class="icon fa fa-check"></i> Perfil Atualizado!
    </div>

    <div class="alert alert-danger alert-dismissible d-none" id="div_status_delete">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <i class="icon fa fa-trash"></i> Registro excluído!
    </div>

    <div class="alert alert-warning alert-dismissible d-none" id="div_status_error">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <i class="icon fa fa-times"></i> Error
    </div>


    <div class="card shadow">
        <div class="card-header py-3">
            <button id="cast" type="button" class="btn btn-primario fa fa-user-plus" data-toggle="modal"
                data-target="#CadastroModal">
                Cadastrar</button>
        </div>
        <div class="card-body">
            <div class="table-responsive-sm">
                <table class="table table-hover table-bordered" id="tableBase">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Descrição</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($perfis as $perfil)
                            <tr>
                                <td class="idDataTabConta">{{ $perfil->id_perfil }}</td>

                                <td>{{ $perfil->descricao }}</td>

                                <td><span @if ($perfil->status > 0) class="badge badge-success" @else class="badge badge-danger" @endif>{{ $perfil->status ? 'Ativo' : 'Inativo' }}</span></td>

                                <td class="actionDataTabConta">
                                    <button type="button" class="btn btn-primario btn-sm fa fa-pencil-square-o"
                                        data-toggle="modal" data-target="#AlterarModal"
                                        data-id="{{ $perfil->id_perfil }}"></button>
                                    <button type="button" class="btn btn-danger btn-sm fa fa-trash-o"
                                        data-id="{{ $perfil->id_perfil }}" data-toggle="modal"
                                        data-target="#modal-danger"></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


        <!-- Modal Cadastro-->
        <div class="modal fade" id="CadastroModal" tabindex="-1" role="dialog" aria-labelledby="CadastroModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="add_modalHeader">
                        <div class="modal-header">
                            <h5 class="modal-title" id="CadastroModalLabel">Novo Cargo</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                    <div class="modal-body">

                        <!-- Form de cadastro -->
                        <form class="form-horizontal" method="POST" action="{{ action('PerfilController@store') }}">
                            @csrf
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <div>
                                        <ul class="nav nav-tabs">
                                            <li class="nav-item"><a class="nav-link active" role="tab" data-toggle="tab"
                                                    href="#tab-1">Cabeçalho</a></li>
                                            <li class="nav-item"><a class="nav-link" role="tab" data-toggle="tab"
                                                    href="#tab-2">Permissões</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active" role="tabpanel" id="tab-1">
                                                <p>
                                                <div class="col-sm-12">
                                                    <label class="control-label">Descrição</label>
                                                    <input class="form-control" type="text" name="descricao" id="descricao"
                                                        maxlength="100" required>
                                                </div>

                                                <div class="col-sm-12">
                                                    <label class="control-label">Status</label>
                                                    <select class="form-control" tabindex="-1" name="status" id="status">
                                                        <option value="1">Ativo</option>
                                                        <option value="0">Inativo</option>
                                                    </select>
                                                </div>
                                                </p>
                                            </div>

                                            <div class="tab-pane" role="tabpanel" id="tab-2">
                                                <p>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="custom-switch">
                                                            <input type="checkbox" class="custom-control-input" id="role1"
                                                                name="role1">
                                                            <label class="custom-control-label"
                                                                for="role1">Administrador</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="custom-switch">
                                                            <input type="checkbox" class="custom-control-input" id="role2"
                                                                name="role2">
                                                            <label class="custom-control-label" for="role2">Alterar
                                                                Registros</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="custom-switch">
                                                            <input type="checkbox" class="custom-control-input" id="role3"
                                                                name="role3">
                                                            <label class="custom-control-label" for="role3">Apagar
                                                                Registros</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="custom-switch">
                                                            <input type="checkbox" class="custom-control-input" id="role4"
                                                                name="role4">
                                                            <label class="custom-control-label" for="role4">Redator</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" id="reset" data-dismiss="modal"><i
                                        class="fa fa-times">
                                        Cancelar</i></button>
                                <button type="submit" class="btn btn-primario" id="btnCadastro" name="btnSalvar"><i
                                        class="fa fa-floppy-o">
                                        Salvar</i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal Alterar-->
        <div class="modal fade" id="AlterarModal" tabindex="-1" role="dialog" aria-labelledby="AlterarModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="add_modalHeader">
                        <div class="modal-header">
                            <h5 class="modal-title" id="AlterarModalLabel">Alterar Usuário</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                    <div class="modal-body">

                        <!-- Form de alteracao -->
                        <form class="form-horizontal" method="POST" action="{{ action('PerfilController@update') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <div>
                                        <ul class="nav nav-tabs">
                                            <li class="nav-item"><a class="nav-link active" role="tab" data-toggle="tab"
                                                    href="#tab-1-alt">Cabeçalho</a></li>
                                            <li class="nav-item"><a class="nav-link" role="tab" data-toggle="tab"
                                                    href="#tab-2-alt">Permissões</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active" role="tabpanel" id="tab-1-alt">
                                                <p>
                                                <div class="col-sm-12">
                                                    <input class="form-control" type="hidden" name="idPerfil"
                                                    id="idPerfil" required>
                                                    <label class="control-label">Descrição</label>
                                                    <input class="form-control" type="text" name="descricaoAlt"
                                                        id="descricaoAlt" maxlength="100" required>
                                                </div>

                                                <div class="col-sm-12">
                                                    <label class="control-label">Status</label>
                                                    <select class="form-control" tabindex="-1" name="statusAlt"
                                                        id="statusAlt">
                                                        <option value="1">Ativo</option>
                                                        <option value="0">Inativo</option>
                                                    </select>
                                                </div>
                                                </p>
                                            </div>

                                            <div class="tab-pane" role="tabpanel" id="tab-2-alt">
                                                <p>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="custom-switch">
                                                            <input type="checkbox" class="custom-control-input"
                                                                id="altRole0" name="altRole1">
                                                            <label class="custom-control-label"
                                                                for="altRole0">Administrador</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="custom-switch">
                                                            <input type="checkbox" class="custom-control-input"
                                                                id="altRole1" name="altRole2">
                                                            <label class="custom-control-label" for="altRole1">Alterar
                                                                Registros</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="custom-switch">
                                                            <input type="checkbox" class="custom-control-input"
                                                                id="altRole2" name="altRole3">
                                                            <label class="custom-control-label" for="altRole2">Apagar
                                                                Registros</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="custom-switch">
                                                            <input type="checkbox" class="custom-control-input"
                                                                id="altRole3" name="altRole4">
                                                            <label class="custom-control-label"
                                                                for="altRole3">Redator</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" id="reset" data-dismiss="modal"><i
                                        class="fa fa-times">
                                        Cancelar</i></button>
                                <button type="submit" class="btn btn-primario" id="btnSalvar" name="btnSalvar"><i
                                        class="fa fa-floppy-o">
                                        Salvar</i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal de Exclusao-->
        <div class="modal fade" id="modal-danger">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="delete_modalHeader">
                        <div class="modal-header">
                            <h4 class="b_text_modal_title_danger"></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" method="POST" action="{{ action('PerfilController@destroy') }}">
                            @csrf
                            <input type="hidden" class="form-control col-form-label-sm" id="iddelete" name="iddelete">
                            <label class="b_text_modal_danger">Deseja realmente excluir este registro?</label>

                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-secondary btn-sm fa fa-times" data-dismiss="modal">
                                    Cancelar</button>
                                <button type="submit" class="btn btn-danger btn-sm fa fa-trash-o"> Confirmar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    @endsection

    @section('js')
        <script src="{{ url('/') }}/js/datatables/jquery.dataTables.js"></script>
        <script src="{{ url('/') }}/js/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
        <script src="{{ url('/') }}/js/plugins/bs-custom-file-input/bs-custom-file-input.js"></script>
        <script src="{{ url('/') }}/js/pages/perfil.js"></script>
        <script src="{{ url('/') }}/js/page.js"></script>
    @endsection
