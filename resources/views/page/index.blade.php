@extends('template.template')

@section('title', 'Home')

@section('content')

    <div class="d-sm-flex justify-content-between align-items-center mb-4">
        <h3 class="text-dark mb-0">Dashboard</h3>
    </div>
    <div class="alert alert-danger alert-dismissible d-none" id="div_status">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <i class="icon fa fa-times"></i> <b>Você não possui permissão para acessar a página anterior! Contate o ADM.</b>
    </div>
    <div class="row">
        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card shadow border-left-primary py-2">
                <div class="card-body">
                    <div class="row align-items-center no-gutters">
                        <div class="col mr-2">
                            <div class="text-uppercase text-primary font-weight-bold text-xs mb-1">
                                <span>Noticias</span>
                            </div>
                            <div class="text-dark font-weight-bold h5 mb-0"><span>40</span></div>
                        </div>
                        <div class="col-auto"><i class="far fa-newspaper fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card shadow border-left-success py-2">
                <div class="card-body">
                    <div class="row align-items-center no-gutters">
                        <div class="col mr-2">
                            <div class="text-uppercase text-success font-weight-bold text-xs mb-1">
                                <span>Contatos</span>
                            </div>
                            <div class="text-dark font-weight-bold h5 mb-0"><span>1</span></div>
                        </div>
                        <div class="col-auto"><i class="far fa-comment-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card shadow border-left-danger py-2" style="height: 102px;">
                <div class="card-body">
                    <div class="row align-items-center no-gutters">
                        <div class="col mr-2">
                            <div class="text-uppercase text-success font-weight-bold text-xs mb-1"
                                style="color: rgb(0,0,0);"><span style="color: rgb(255,15,0);">Arquivos</span></div>
                            <div class="text-dark font-weight-bold h5 mb-0"><span>1</span></div>
                        </div>
                        <div class="col-auto"><i class="fas fa-file-csv fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card shadow border-left-warning py-2">
                <div class="card-body">
                    <div class="row align-items-center no-gutters">
                        <div class="col mr-2">
                            <div class="text-uppercase text-warning font-weight-bold text-xs mb-1">
                                <span>Usuários</span>
                            </div>
                            <div class="text-dark font-weight-bold h5 mb-0"><span>{{$countUsers}}</span></div>
                        </div>
                        <div class="col-auto"><i class="fas fa-user-friends fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Start: Chart -->
    <div class="row">
        <div class="col-lg-7 col-xl-8">
            <div class="card shadow mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="text-primary font-weight-bold m-0">Gráfico de Acessos</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area"><canvas
                            data-bs-chart="{&quot;type&quot;:&quot;line&quot;,&quot;data&quot;:{&quot;labels&quot;:[&quot;Jan&quot;,&quot;Feb&quot;,&quot;Mar&quot;,&quot;Apr&quot;,&quot;May&quot;,&quot;Jun&quot;,&quot;Jul&quot;,&quot;Aug&quot;],&quot;datasets&quot;:[{&quot;label&quot;:&quot;Earnings&quot;,&quot;fill&quot;:true,&quot;data&quot;:[&quot;0&quot;,&quot;10000&quot;,&quot;5000&quot;,&quot;15000&quot;,&quot;10000&quot;,&quot;20000&quot;,&quot;15000&quot;,&quot;25000&quot;],&quot;backgroundColor&quot;:&quot;rgba(78, 115, 223, 0.05)&quot;,&quot;borderColor&quot;:&quot;rgba(78, 115, 223, 1)&quot;}]},&quot;options&quot;:{&quot;maintainAspectRatio&quot;:false,&quot;legend&quot;:{&quot;display&quot;:false},&quot;title&quot;:{},&quot;scales&quot;:{&quot;xAxes&quot;:[{&quot;gridLines&quot;:{&quot;color&quot;:&quot;rgb(234, 236, 244)&quot;,&quot;zeroLineColor&quot;:&quot;rgb(234, 236, 244)&quot;,&quot;drawBorder&quot;:false,&quot;drawTicks&quot;:false,&quot;borderDash&quot;:[&quot;2&quot;],&quot;zeroLineBorderDash&quot;:[&quot;2&quot;],&quot;drawOnChartArea&quot;:false},&quot;ticks&quot;:{&quot;fontColor&quot;:&quot;#858796&quot;,&quot;padding&quot;:20}}],&quot;yAxes&quot;:[{&quot;gridLines&quot;:{&quot;color&quot;:&quot;rgb(234, 236, 244)&quot;,&quot;zeroLineColor&quot;:&quot;rgb(234, 236, 244)&quot;,&quot;drawBorder&quot;:false,&quot;drawTicks&quot;:false,&quot;borderDash&quot;:[&quot;2&quot;],&quot;zeroLineBorderDash&quot;:[&quot;2&quot;]},&quot;ticks&quot;:{&quot;fontColor&quot;:&quot;#858796&quot;,&quot;padding&quot;:20}}]}}}"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5 col-xl-4">
            <div class="card shadow mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="text-primary font-weight-bold m-0">Gráfico de Categorias</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area"><canvas
                            data-bs-chart="{&quot;type&quot;:&quot;doughnut&quot;,&quot;data&quot;:{&quot;labels&quot;:[&quot;Direct&quot;,&quot;Social&quot;,&quot;Referral&quot;],&quot;datasets&quot;:[{&quot;label&quot;:&quot;&quot;,&quot;backgroundColor&quot;:[&quot;#4e73df&quot;,&quot;#1cc88a&quot;,&quot;#36b9cc&quot;],&quot;borderColor&quot;:[&quot;#ffffff&quot;,&quot;#ffffff&quot;,&quot;#ffffff&quot;],&quot;data&quot;:[&quot;50&quot;,&quot;30&quot;,&quot;15&quot;]}]},&quot;options&quot;:{&quot;maintainAspectRatio&quot;:false,&quot;legend&quot;:{&quot;display&quot;:false},&quot;title&quot;:{}}}"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End: Chart -->
    <div class="row">
        <div class="col mb-4s">
            <!-- Start: Collapsible Card -->
            <div class="shadow card"><a class="btn btn-link text-left card-header font-weight-bold" data-toggle="collapse"
                    aria-expanded="true" aria-controls="postagem" href="#postagem" role="button">Última Postagem</a>
                <div class="collapse show" id="postagem">
                    <div class="card-body">
                        <p class="m-0">This is a collapsable card example using Bootstrap's built in
                            collapse functionality.&nbsp;<strong>Click on the card
                                header</strong>&nbsp;to see the card body collapse and expand!</p>
                    </div>
                </div>
            </div>
            <!-- End: Collapsible Card -->
        </div>
        <div class="col-xl-5 offset-xl-0 mb-4">
            <!-- Start: Collapsible Card -->
            <div class="shadow card"><a class="btn btn-link text-left card-header badge-danger font-weight-bold text-white"
                    data-toggle="collapse" aria-expanded="true" aria-controls="comunicado" href="#comunicado"
                    role="button">Comunicados</a>
                <div class="collapse show" id="comunicado">
                    <div class="card-body"></div>
                </div>
            </div>
            <!-- End: Collapsible Card -->
        </div>

    </div>
@endsection

@section('js')
<script src="{{ url('/') }}/js/page.js"></script>
<script src="{{ url('/') }}/js/pages/index.js"></script>
@endsection
