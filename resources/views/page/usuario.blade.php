@extends('template.template')

@section('title', 'Usuários')
@section('css')
<link rel="stylesheet" href="{{url('/')}}/js/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')

    <div class="d-sm-flex justify-content-between align-items-center mb-4">
        <h3 class="text-dark mb-0">Cadastro</h3>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="/">Início</a></li>
            <li class="breadcrumb-item"><b>Cadastro: Usuários</b></li>
        </ul>
    </div>


    <div class="alert alert-success alert-dismissible d-none" id="div_status">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <i class="icon fa fa-check"></i> Registro Salvo/Atualizado!
    </div>

    <div class="alert alert-info alert-dismissible d-none" id="div_status_reset">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <i class="icon fa fa-check"></i> Senha resetada!
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
            <button id="cast" type="button" class="btn btn-primario fa fa-user-plus" data-toggle="modal" data-target="#CadastroModal">
                Cadastrar</button>
        </div>
        <div class="card-body">
            <div class="table-responsive-sm">
                <table class="table table-hover table-bordered" id="tableBase" >
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th >Nome</th>
                            <th>Perfil</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usuarios as $usuario)
                            <tr>
                                <td class="idDataTabConta">{{ $usuario->id_usuario }}</td>

                                <td>{{ $usuario->nome }}</td>

                                <td class="statusDataTabConta">{{ $usuario->rperfil->descricao }}</td>


                                <td><span @if ( $usuario->status > 0) class="badge badge-success" @else class="badge badge-danger"
                                    @endif>{{ $usuario->status ? "Ativo" : "Inativo"}}</span></td>



                                <td class="actionDataTabConta">
                                    <button type="button" class="btn btn-primario btn-sm fa fa-pencil-square-o"
                                        data-toggle="modal" data-target="#AlterarModal"
                                        data-id="{{ $usuario->id_usuario }}"></button>
                                    <button type="button" class="btn btn-primario btn-sm fa fa-key" data-toggle="modal"
                                        data-target="#modal-password" data-id="{{ $usuario->id_usuario }}"></button>
                                    <button type="button" class="btn btn-danger btn-sm fa fa-trash-o"
                                        data-id="{{ $usuario->id_usuario }}" data-toggle="modal"
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
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="add_modalHeader">
                        <div class="modal-header">
                            <h5 class="modal-title" id="CadastroModalLabel">Novo Usuário</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                    <div class="modal-body">

                        <!-- Form de cadastro -->
                        <form class="form-horizontal" method="POST" id="formId" action="{{action('UsuarioController@store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <p><img id="previewImg" src="storage/img/avatars/default.jpg" class="imgCad"></p>
                                </div>
                                <div class="col-sm-6">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile" name="fotocad"
                                            accept=".jpg,.jpeg,.png">

                                        <label class="custom-file-label" for="customFile"><span id="nome"
                                                class="textInput">Selecione o Avatar</span></label>
                                    </div><br>

                                    <label class="control-label">Email</label>
                                    <input class="form-control" type="email" name="emailcad" id="email" maxlength="150"
                                        required>
                                    <label class="control-label">Senha</label>
                                    <p><input class="form-control" type="password" name="passwordcad" id="password"
                                            maxlength="8" placeholder="Máximo de 8 caracteres" required></p>
                                </div>

                                <div class="col-sm-6">
                                    <label class="control-label">Nome</label>
                                    <input class="form-control" type="text" name="nomecad" id="nome" maxlength="250"
                                        required>
                                </div>

                                <div class="col-sm-2">
                                    <label class="control-label">Status</label>
                                    <select class="form-control" tabindex="-1" name="statuscad" id="status">
                                        <option value="1">Ativo</option>
                                        <option value="0">Inativo</option>
                                    </select>
                                </div>

                                <div class="col-sm-4">
                                    <label class="control-label">Perfil</label>
                                    <select class="form-control" tabindex="-1" name="perfilcad" id="perfil">
                                        @foreach ($perfis as $perfil)
                                            <option value="{{ $perfil->id_perfil }}">{{ $perfil->descricao }}</option>
                                        @endforeach
                                    </select>
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
            <div class="modal-dialog modal-lg" role="document">
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
                        <form class="form-horizontal" method="POST" action="{{action('UsuarioController@update')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <p><img id="previewImgAlt" src="storage/img/avatars/default.jpg" class="imgCad"></p>
                                </div>
                                <div class="col-sm-6">
                                    <p><div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFileAlt" name="fotoAlt"
                                            accept=".jpg,.jpeg,.png">

                                        <label class="custom-file-label" for="customFileAlt"><span id="nomeArqAlt"
                                                class="textInput">Selecione o Avatar</span></label>
                                    </div></p>

                                    <label class="control-label">Email</label>
                                    <input class="form-control" type="email" name="emailAlt" id="emailAlt" maxlength="150"
                                        required>
                                    <input class="form-control" type="hidden" name="idUserAlt" id="idUserAlt" required>
                                </div>

                                <div class="col-sm-6">
                                    <label class="control-label">Nome</label>
                                    <input class="form-control" type="text" name="nomeAlt" id="nomeAlt" maxlength="250"
                                        required>
                                </div>

                                <div class="col-sm-2">
                                    <label class="control-label">Status</label>
                                    <select class="form-control" tabindex="-1" name="statusAlt" id="statusAlt">
                                        <option value="1">Ativo</option>
                                        <option value="0">Inativo</option>
                                    </select>
                                </div>

                                <div class="col-sm-4">
                                    <label class="control-label">Perfil</label>
                                    <select class="form-control" tabindex="-1" name="perfilAlt" id="perfilAlt">
                                        @foreach ($perfis as $perfil)
                                            <option value="{{ $perfil->id_perfil }}">{{ $perfil->descricao }}</option>
                                        @endforeach
                                    </select>
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
                        <form class="form-horizontal" method="POST" action="{{action('UsuarioController@destroy')}}">
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

        <!-- Modal Resetar Senha-->
        <div class="modal fade" id="modal-password">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="add_modalHeader">
                        <div class="modal-header">
                            <h4 class="b_text_modal_title_password"></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" method="POST" action="{{action('UsuarioController@resetPassword')}}">
                            @csrf
                            <input type="hidden" class="form-control col-form-label-sm" id="idUser" name="idUser">
                            <label class="b_text_modal_password">Deseja realmente resetar a senha deste usuário? <br> A
                                senha padrão será:
                                123</label>

                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-secondary btn-sm fa fa-times" data-dismiss="modal">
                                    Cancelar</button>
                                <button type="submit" class="btn btn-primario btn-sm fa fa-trash-o"> Confirmar</button>
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
        <script src="{{ url('/') }}/js/pages/usuario.js"></script>
        <script src="{{ url('/') }}/js/page.js"></script>
    @endsection
