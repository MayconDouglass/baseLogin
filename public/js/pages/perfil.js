$(function() {

    $("#tableBase").DataTable({
        "autoWidth": false
    });
    $('#example1').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
    });

    if ($.cookie('status') != null) {
        let status = $.cookie('status');

        switch (status) {
            case 'Salvo':
                exibirAtualizadoSucesso();
                setTimeout(function() {
                    exibirAtualizadoSucesso();
                    $('#div_status').hide();
                }, 8000);

                break;
            case 'Excluido':
                exibirExcluidoSucesso();
                setTimeout(function() {
                    exibirExcluidoSucesso();
                    $('#div_status_delete').hide();
                }, 8000);


                break;
            case 'Erro':
                exibirErroSucesso();
                setTimeout(function() {
                    exibirErroSucesso();
                    $('#div_status_erro').hide();
                }, 8000);

                break;

            default:
                $.removeCookie("status", { path: '/cargo' });
                break;
        }
        $.removeCookie("status", { path: '/cargo' });
    }



});


function exibirAtualizadoSucesso() {
    $("#div_status").removeClass("d-none");
}

function exibirResetadoSucesso() {
    $("#div_status_reset").removeClass("d-none");
}

function exibirExcluidoSucesso() {
    $("#div_status_delete").removeClass("d-none");
}

function exibirErroSucesso() {
    $("#div_status_error").removeClass("d-none");
}

$('#modal-danger').on('show.bs.modal', function(event) {
    let button = $(event.relatedTarget) // Botão que acionou o modal
    let iddelete = button.data('id')
    $("#iddelete").val(iddelete);
    let modal = $(this)
    modal.find('.b_text_modal_title_danger').text('Excluir Registro')
})

$('#AlterarModal').on('show.bs.modal', function(event) {
    let button = $(event.relatedTarget) // Botão que acionou o modal
    let idPerfil = button.data('id')

    $.ajax({
        type: 'get',
        dataType: 'json',
        url: '/api/perfis/' + idPerfil,

        success: function(result) {
            let dados = result.response;
            let permissoes = result.permissoes;

            for (let i = 0; i < permissoes.length + 1; i++) {
                $("#altRole".concat(i)).prop("checked", permissoes[i] ? true : false).trigger("change");
            }

            $("#descricaoAlt").val(dados.descricao).trigger("change");
            $("#idPerfil").val(dados.id_perfil).trigger("change");
            $("#statusAlt").val(dados.status).trigger("change");

        },
        error: function(resultError) {

            console.log('Erro na consulta');

        }

    });

    let modal = $(this)
    modal.find('.modal-title').text('Alterar Registro')
})