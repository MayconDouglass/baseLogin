$(function() {

    $("#tableBase").DataTable({
        "autoWidth": true,

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
            case 'Resetado':
                exibirResetadoSucesso();
                setTimeout(function() {
                    exibirResetadoSucesso();
                    $('#div_status_reset').hide();
                }, 8000);

                break;

            default:
                $.removeCookie("status", { path: '/usuario' });
                break;
        }
        $.removeCookie("status", { path: '/usuario' });
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

function exibirRemovidoSucesso() {
    $("#div_status_error").removeClass("d-none");
}

//preview upload img
$('#customFile').change(function() {
    const file = $(this)[0].files[0]
    const fileReader = new FileReader()
    fileReader.onloadend = function() {
        $('#previewImg').attr('src', fileReader.result)
        $('#nome').text(file.name)
        console.log($('#customFile').val());
    }
    fileReader.readAsDataURL(file)
})

$('#customFileAlt').change(function() {
    const file = $(this)[0].files[0]
    const fileReader = new FileReader()
    fileReader.onloadend = function() {
        $('#previewImgAlt').attr('src', fileReader.result)
        $('#nomeArqAlt').text(file.name)
    }
    fileReader.readAsDataURL(file)
})

$('#modal-danger').on('show.bs.modal', function(event) {
    let button = $(event.relatedTarget) // Botão que acionou o modal
    let iddelete = button.data('id')
    $("#iddelete").val(iddelete);
    let modal = $(this)
    modal.find('.b_text_modal_title_danger').text('Excluir Registro')
})

$('#modal-password').on('show.bs.modal', function(event) {
    let button = $(event.relatedTarget) // Botão que acionou o modal
    let idUser = button.data('id')
    $("#idUser").val(idUser);
    let modal = $(this)
    modal.find('.b_text_modal_title_password').text('Resetar Password')
})

$('#AlterarModal').on('show.bs.modal', function(event) {
    let button = $(event.relatedTarget) // Botão que acionou o modal
    let idUser = button.data('id')

    $.ajax({
        type: 'get',
        dataType: 'json',
        url: '/api/usuarios/' + idUser,

        success: function(result) {
            let dados = result.response;
            let padraoIMG = 'storage/img/avatars/default.jpg';

            if (dados.avatar) {
                $("#previewImgAlt").attr('src', dados.avatar).trigger("change");
            } else {
                $("#previewImgAlt").attr('src', padraoIMG).trigger("change");
            }

            $("#nomeAlt").val(dados.nome).trigger("change");
            $("#emailAlt").val(dados.email).trigger("change");
            $("#statusAlt").val(dados.status).trigger("change");
            $("#perfilAlt").val(dados.idPerfil).trigger("change");
            $("#idUserAlt").val(dados.id_usuario).trigger("change");

        },
        error: function(resultError) {

            console.log('Erro na consulta');

        }

    });

    let modal = $(this)
    modal.find('.modal-title').text('Alterar Registro')
})
