$(function () {
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

    $('.select2').select2({
        dropdownParent: $("#CadastroModal"),
        width: '100%'
    });
    $('.select-notsearch').select2({
        dropdownParent: $("#CadastroModal"),
        width: '100%',
        minimumResultsForSearch: Infinity
    });
});

//preview upload img
$('#customFile').change(function () {
    const file = $(this)[0].files[0]
    const fileReader = new FileReader()
    fileReader.onloadend = function () {
        $('#previewImg').attr('src', fileReader.result)
    }
    fileReader.readAsDataURL(file)
})

$('#customFileAlt').change(function () {
    const file = $(this)[0].files[0]
    const fileReader = new FileReader()
    fileReader.onloadend = function () {
        $('#previewImgAlt').attr('src', fileReader.result)
    }
    fileReader.readAsDataURL(file)
})

$('#modal-danger').on('show.bs.modal', function (event) {
    let button = $(event.relatedTarget) // Botão que acionou o modal
    let iddelete = button.data('codigo')
    $("#iddelete").val(iddelete);
    let modal = $(this)
    modal.find('.b_text_modal_title_danger').text('Excluir Registro')
})

$('#modal-password').on('show.bs.modal', function (event) {
    let button = $(event.relatedTarget) // Botão que acionou o modal
    let idUser = button.data('codigo')
    $("#idUser").val(idUser);
    let modal = $(this)
    modal.find('.b_text_modal_title_password').text('Resetar Password')
})

$('#AlterarModal').on('show.bs.modal', function (event) {
    let button = $(event.relatedTarget) // Botão que acionou o modal
    let userCodAlt = button.data('codigo')
    let nomeAlt = button.data('nome')
    let emailAlt = button.data('email')
    let cargoAlt = button.data('cargo')
    let statusAlt = button.data('status')
    let fotoAlt = button.data('imgalt')

    $('#previewImgAlt').attr('src', fotoAlt);

    $("#cargoAlt").select2({
        dropdownParent: $("#AlterarModal"), width: '100%',
    }).val(cargoAlt).trigger("change");

    $("#statusAlt").select2({
        dropdownParent: $("#AlterarModal"), width: '100%',
        minimumResultsForSearch: Infinity
    }).val(statusAlt).trigger("change");
    
    
    let modal = $(this)
    modal.find('.modal-title').text('Alterar Registro')
    modal.find('#userAlt').val(userCodAlt)
    modal.find('#nomeAlt').val(nomeAlt)
    modal.find('#emailAlt').val(emailAlt)
})

$('#VisualizarModal').on('show.bs.modal', function (event) {
    let button = $(event.relatedTarget) // Botão que acionou o modal
    let userCodView = button.data('codigo')
    let nomeView = button.data('nome')
    let emailView = button.data('email')
    let cargoView = button.data('cargo')
    let statusView = button.data('status')
    let fotoView = button.data('imgview')

    $('#previewImgView').attr('src', fotoView);

    $("#cargoView").select2({
        dropdownParent: $("#AlterarModal"), width: '100%',
    }).val(cargoView).trigger("change");

    $("#statusView").select2({
        dropdownParent: $("#AlterarModal"), width: '100%',
        minimumResultsForSearch: Infinity
    }).val(statusView).trigger("change");
    
    
    let modal = $(this)
    modal.find('.modal-title').text('Visualizar Registro')
    modal.find('#nomeView').val(nomeView)
    modal.find('#emailView').val(emailView)
})