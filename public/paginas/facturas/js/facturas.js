$(function () {

    const modal_facturas = $('#modal-facturas');
    const modal_facturas_bs = new bootstrap.Modal(modal_facturas[0], {backdrop: 'static'});
    const modal_eliminar = $('#modal-eliminar');
    const modal_eliminar_bs = new bootstrap.Modal(modal_eliminar[0], {backdrop: 'static'});
    let id_activo = null;

   $( function()  {
       $('#factura-fecha-pago').daterangepicker({
           singleDatePicker: true,
           autoApply: true,
           locale: bootstrap_daterangepicker_locale
       });
    } );

    $('#factura-pago').select2({
        width: '100%',
        placeholder: 'Seleccione un método de pago',
        allowClear: false, //para poder deseleccionar
        minimumResultsForSearch: Infinity,
    });

    $('#factura-numero-reserva').select2({
        width: '100%',
        placeholder: 'Seleccione una reserva',
        allowClear: true //para poder deseleccionar
    });


    $('#nueva-factura').on('click', function () {
        id_activo = null;
        modal_facturas.find('.modal-title').html('Nueva factura');
        modal_facturas.find('input').val('');
        modal_facturas_bs.show();
    });


    let table = $('#tabla-facturas').DataTable({ // el id es la tabla
        ajax: {
            type: 'post',
            url: BASE_URL + 'facturas',
            dataSrc: '',
        },
        columns: [
            {data: 'id', title: 'Factura'},
            {data: 'id_reserva', title: 'Reserva'},
            {data: 'fecha', title: 'Fecha factura', render: renderDate},
            {data: 'forma_pago', title: 'Forma de pago'},
            {data: 'timestamp_pago', title: 'Fecha de pago'},

            {
                data: 'id',
                orderable: false,
                className: 'text-nowrap',
                width: '5px',
                render: function (data, type, row, meta) {
                    return `
                    <button class="btn btn btn-outline-secondary btn-xs detalles">
                        <i class="fa fa-eye"></i>
                    </button>
                    <button class="btn btn btn-outline-danger btn-xs eliminar">
                        <i class="fa fa-trash"></i>
                    </button>`;
                }
            },
        ],
        language: datatables_locale,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
        pageLength: 10,
        order: [[1, 'asc'], [2, 'asc']],
        scrollX: true,
        drawCallback: function (settings) {

        }

    }).on('click', '.detalles', function () {
        let tr = $(this).closest('tr');
        let datos = table.row(tr).data();
        id_activo = datos.id;
        modal_facturas.find('.modal-title').html('Factura # ' + datos.id);
        $('#facturas-usuario').val(datos.usuario);
        $('#facturas-password').val('');
        $('#facturas-id_personal').val(datos.id_personal).trigger('change');
        $('#facturas-perfil').val(datos.perfil).trigger('change');
        modal_facturas_bs.show();

    }).on('click', '.eliminar', function () {
        let tr = $(this).closest('tr');
        let datos = table.row(tr).data();
        id_activo = datos.id;
        modal_eliminar.find('.modal-title-text').html('Eliminar usuario');
        modal_eliminar.find('.mensaje').html(`¿Está seguro de que quiere eliminar el usuario <i class="text-nowrap">${datos.usuario}</i>?`);
        modal_eliminar_bs.show();
    });


    // modal_facturas.find('.aceptar').on('click', function () {
    //
    // })

    modal_facturas.on('hidden.bs.modal', function () {
        limpiarErrores(modal_facturas);
    }).on('click', '.aceptar', function () {
        //cogemos los datos del formulario en JSON
        let datos_form = serializeArrayJson('#form-facturas');
        datos_form.id = id_activo
        //enviar los datos al servidor mediante POST (usando AJAX)
        $.post(BASE_URL + 'facturas/guardar', datos_form, function () {
            //se ejecuta cuando recibe respuesta válida

            //recargar el datatables
            table.ajax.reload();
            //ocultar el modal
            modal_facturas_bs.hide();
        }).fail(function (error) {
            mostrarErrores(error, modal_facturas);
        })
    });


    modal_eliminar.on('click', '.eliminar', function () {
        //enviar los datos al servidor mediante POST (usando AJAX)
        let datos_envio = {
            id: id_activo // le decimos al servidor que su id es el id_activo
        };
        $.post(BASE_URL + 'facturas/eliminar', datos_envio, function () {
            //se ejecuta cuando recibe respuesta válida

            //recargar el datatables
            table.ajax.reload();
            //ocultar el modal
            modal_eliminar_bs.hide();
        })
    });
});
