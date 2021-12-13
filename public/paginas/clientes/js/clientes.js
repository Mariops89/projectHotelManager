$(function () {

    const modal_clientes = new bootstrap.Modal(document.getElementById('modal-clientes'), {backdrop: 'static'});

    // modal_clientes.show();



    let table = $('#tabla-clientes').DataTable({
        ajax: {
            type: 'post',
            url: BASE_URL + 'clientes',
            dataSrc: '',
        },
        columns: [
            {data: 'nombre', title: 'Nombre'},
            {data: 'apellidos', title: 'Apellidos'},
            {data: 'direccion', title: 'Dirección'},
        ],
        language: datatables_locale,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
        pageLength: 25,
        order: [[1, 'asc']],
        scrollX: true,
        drawCallback: function(settings) {

        }

    })



});
