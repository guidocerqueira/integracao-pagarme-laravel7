$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.delete_item_sweet').click(function () {
        const action = $(this).data('action');

        Swal.fire({
            title: 'Tem Certeza?',
            text: "Esta ação não poderá ser revertida!",
            type: 'warning',
            allowOutsideClick: false,
            allowEscapeKey: false,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, excluir!',
            cancelButtonText: 'Cancelar',
        }).then((result) => {
            if (result.value){
                Swal.fire({
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    onBeforeOpen: () => {
                        Swal.showLoading();
                    },
                    title: 'Aguarde'
                });
                
                $.ajax({
                    type: 'DELETE',
                    url: action,
                    dataType: 'JSON',
                    data: {},
                    success: function (response) {
                        if (response.delete) {
                            Swal.fire({
                                title: 'Excluido!',
                                text: response.message,
                                type: 'success',
                                showConfirmButton: false,
                                timer: 2000,
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                onClose: window.location.href = response.redirect
                            })
                        }

                        if (response.error) {
                            Swal.fire({
                                title: 'Não Excluido!',
                                text: response.message,
                                type: 'error',
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                showConfirmButton: true
                            })
                        }
                    }
                });
            }
        })
    });
});