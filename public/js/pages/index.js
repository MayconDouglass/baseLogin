$(function() {

    if ($.cookie('status') != null) {
        let status = $.cookie('status');

        switch (status) {
            case 'NoPermission':
                exibirPermissaoSucesso();
                setTimeout(function() {
                    exibirPermissaoSucesso();
                    $('#div_status').hide();
                }, 8000);

                break;

            default:
                $.removeCookie("status", { path: '/' });
                break;
        }
        $.removeCookie("status", { path: '/' });
    }



});


function exibirPermissaoSucesso() {
    $("#div_status").removeClass("d-none");
}