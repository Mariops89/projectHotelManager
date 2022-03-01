$(function () {

    const modal_detalles = $('#modal-detalles');
    const modal_detalles_bs = new bootstrap.Modal(modal_detalles[0], {backdrop: 'static'});
    const modal_factura = $('#modal-factura');
    const modal_factura_bs = new bootstrap.Modal(modal_factura[0], {backdrop: 'static'});
    const modal_eliminar = $('#modal-eliminar');
    const modal_eliminar_bs = new bootstrap.Modal(modal_eliminar[0], {backdrop: 'static'});
    const modal_error = $('#modal-error');
    const modal_error_bs = new bootstrap.Modal(modal_error[0], {backdrop: 'static'});
    let id_activo = null;
    let id_factura_activo = null;


    $('#fechas').daterangepicker({
        locale: bootstrap_daterangepicker_locale,
        ranges: bootstrap_daterangepicker_ranges,
        startDate: moment().startOf('month'),
        endDate: moment().endOf('month')
        // alwaysShowCalendars: true

    }).on('apply.daterangepicker', function(ev, picker) {
        table.ajax.reload();
    });


    $('#factura-pago').select2({
        width: '100%',
        minimumResultsForSearch: Infinity
    })


    let table = $('#tabla-reservas').DataTable({ // el id es la tabla
        ajax: {
            type: 'post',
            url: BASE_URL + 'reservas',
            dataSrc: '',
            data: function (d) {
                let drp = $('#fechas').data('daterangepicker');
                d.inicio = drp.startDate.format('YYYY-MM-DD');
                d.fin = drp.endDate.format('YYYY-MM-DD');
            }
        },
        columns: [
            {data: 'id', title: 'Número de reserva'},
            {data: 'habitacion.numero', title: 'Habitación'},
            {data: 'cliente.dni', title: 'DNI Cliente'},
            {data: 'fecha_entrada', title: 'Fecha de entrada', render: renderDate},
            {data: 'fecha_salida', title: 'Fecha de salida', render: renderDate},
            {data: 'personas', title: 'Número de personas'},
            {data: 'precio', title: 'Precio'},
            {
                data: 'late_checkout', title: 'Late checkout',

                render: function (data, type, row, meta) {
                    if (data === 0) {
                        return '<span>No</span>'
                    } else {
                        return '<span>Sí</span>'
                    }
                }
            },
            {data: 'timestamp_entrada', title: 'Check-in', className: 'text-nowrap', render: renderDatetime},
            {data: 'timestamp_salida', title: 'Check-out', className: 'text-nowrap', render: renderDatetime},
            {data: 'factura', title: 'Facturada',
                render: function (data, type, row, meta) {
                    if (data === null) {
                        return '<span class="badge bg-danger fs-6">Pendiente de facturar</span>'
                    } else if (data.timestamp_pago === null) {
                        return `<span class="badge bg-warning fs-6">${data.numero} Pendiente de pago</span>`
                    } else {
                        return `<span class="badge bg-success fs-6">${data.numero} Pagada</span>`
                    }
                }
            },
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
                        <button class="btn btn btn-outline-secondary btn-xs factura">
                            <i class="fa fa-file-alt"></i>
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
        order: [[0, 'asc']],
        scrollX: true,
        drawCallback: function (settings) {

        }


    }).on('click', '.detalles', function () {
        let tr = $(this).closest('tr');
        let datos = table.row(tr).data();
        id_activo = datos.id;

        modal_detalles.find('.modal-title').html('Reserva # ' + datos.id)
        $('#datos-reserva .numero-reserva').html(datos.id);
        $('#datos-reserva .habitacion-reserva').html(datos.habitacion.numero);
        $('#datos-reserva .fecha-entrada').html(dateFormat(datos.fecha_entrada));
        $('#datos-reserva .fecha-salida').html(dateFormat(datos.fecha_salida));
        $('#datos-reserva .personas-reserva').html(datos.personas);
        $('#datos-reserva .precio-reserva').html(datos.precio + ' euros');
        $('#datos-reserva .late-checkout-reserva').html(datos.late_checkout === 1 ? 'Sí' : 'No');
        $('#datos-reserva .check-in-reserva').html(dateTimeFormat(datos.timestamp_entrada));
        $('#datos-reserva .check-out-reserva').html(dateTimeFormat(datos.timestamp_salida));


        $('#datos-cliente .dni-cliente-reserva').html(datos.cliente.dni);
        $('#datos-cliente .nombre-cliente-reserva').html(datos.cliente.nombre);
        $('#datos-cliente .apellidos-cliente-reserva').html(datos.cliente.apellidos);
        $('#datos-cliente .telefono-cliente-reserva').html(datos.cliente.telefono);
        $('#datos-cliente .direccion-cliente-reserva').html(datos.cliente.direccion);
        $('#datos-cliente .localidad-cliente-reserva').html(datos.cliente.localidad);
        $('#datos-cliente .cp-cliente-reserva').html(datos.cliente.cod_postal);
        $('#datos-cliente .provincia-cliente-reserva').html(datos.cliente.provincia);
        $('#datos-cliente .pais-cliente-reserva').html(datos.cliente.pais);


        if (datos.timestamp_entrada === null) {
            $('#detalles-footer .check-in-button').show();
            $('#detalles-footer .check-out-button').hide();
        } else if (datos.timestamp_salida === null) {
            $('#detalles-footer .check-out-button').show();
            $('#detalles-footer .check-in-button').hide();
        } else {
            $('#detalles-footer .check-in-button').hide();
            $('#detalles-footer .check-out-button').hide();
        }

        modal_detalles_bs.show();

    }).on('click', '.factura', function () {
        let tr = $(this).closest('tr');
        let datos = table.row(tr).data();
        id_activo = datos.id;

        if (datos.factura === null) {
            id_factura_activo = null;
            modal_factura.find('.modal-title').html('Facturar reserva');
            $('#modal-factura .numero-factura').html('se generará automáticamente');
            $('#modal-factura .numero-reserva').html(datos.id);
            $('#modal-factura .fecha-factura').html('se generará automáticamente');
            $('#modal-factura .habitacion-reserva').html(datos.habitacion.numero);
            $('#modal-factura .cliente').html(datos.cliente.dni + ' - ' + datos.cliente.nombre + ' ' + datos.cliente.apellidos);
            $('#modal-factura .pagada').prop('checked', false);
            $('#modal-factura #factura-pago').parent().hide();
            $('#modal-factura #tabla-lineas').hide();
        } else {
            id_factura_activo = datos.factura.id;
            modal_factura.find('.modal-title').html('Editar factura');
            $('#modal-factura .numero-factura').html(datos.factura.numero);
            $('#modal-factura .numero-reserva').html(datos.id);
            $('#modal-factura .fecha-factura').html(renderDate(datos.factura.fecha));
            $('#modal-factura .habitacion-reserva').html(datos.habitacion.numero);
            $('#modal-factura .cliente').html(datos.cliente.dni + ' - ' + datos.cliente.nombre + ' ' + datos.cliente.apellidos);
            if (datos.factura.timestamp_pago === null) {
                $('#modal-factura .pagada').prop('checked', false);
                $('#modal-factura #factura-pago').parent().hide();
            } else {
                $('#modal-factura .pagada').prop('checked', true);
                $('#modal-factura #factura-pago').parent().show();
                $('#modal-factura #factura-pago').val(datos.factura.forma_pago).trigger('change');
            }
            $('#modal-factura #tabla-lineas').show();

            let lineas = '';
            $.each(datos.factura.lineas, function (k, linea) {
                lineas += `<tr>
                    <td>${linea.concepto}</td>
                    <td>${linea.cantidad}</td>
                    <td>${parseFloat(linea.precio).toFixed(2)}</td>
                    <td>${parseFloat(linea.base_imponible).toFixed(2)}</td>
                    <td>${parseFloat(linea.iva).toFixed(2)}</td>
                    <td>${parseFloat(linea.subtotal).toFixed(2)}</td>
                </tr>`;
            });
            $('#tabla-lineas tbody').html(lineas);
            $('#tabla-lineas .subtotal').html(parseFloat(datos.factura.subtotal).toFixed(2));
            $('#tabla-lineas .iva').html(parseFloat(datos.factura.iva).toFixed(2));
            $('#tabla-lineas .total').html(parseFloat(datos.factura.total).toFixed(2));
        }

        modal_factura_bs.show();
    }).on('click', '.eliminar', function () {
        let tr = $(this).closest('tr');
        let datos = table.row(tr).data();
        id_activo = datos.id;
        modal_eliminar.find('.modal-title-text').html('Eliminar reserva');
        modal_eliminar.find('.mensaje').html(`¿Está seguro de que quiere eliminar la reserva <i class="text-nowrap">${datos.id}</i>?`);
        modal_eliminar_bs.show();
    });


    modal_detalles.on('click', '.check-in-button', function () {
        let datos_envio = {
            id: id_activo //le mandamos el id a PHP
        };
        //petición para guardar los timestamp
        //no entra aqui
        $.post(BASE_URL + 'reservas/guardarcheckin', datos_envio, function () {
            table.ajax.reload();
            modal_detalles_bs.hide();
        })
    }).on('click', '.check-out-button', function () {
        let datos_envio = {
            id: id_activo //le mandamos el id a PHP
        };
        //petición para guardar los timestamp
        //no entra aqui
        $.post(BASE_URL + 'reservas/guardarcheckout', datos_envio, function () {
            table.ajax.reload();
            modal_detalles_bs.hide();
        })
    });


    modal_eliminar.on('click', '.eliminar', function () {
        //enviar los datos al servidor mediante POST (usando AJAX)
        let datos_envio = {
            id: id_activo
        };
        $.post(BASE_URL + 'reservas/eliminar', datos_envio, function (respuesta) {
            //se ejecuta cuando recibe respuesta válida
            if (respuesta.borrado) {

                //recargar el datatables
                table.ajax.reload();
                //ocultar el modal
                modal_eliminar_bs.hide();
            } else {
                modal_eliminar_bs.hide();
                modal_error.find('.mensaje').html(`No se puede eliminar una reserva que ya ha sido facturada`);
                modal_error_bs.show();
            }
        }, 'json')
    });


    modal_factura.on('change', '.pagada', function () {
        if ($(this).is(':checked')) {
            $('#factura-pago').parent().show();
        } else {
            $('#factura-pago').parent().hide();
        }
    }).on('click', '.aceptar', function() {
        let datos_form = serializeArrayJson('#form-factura');
        datos_form.id = id_factura_activo;
        datos_form.id_reserva = id_activo;
        $.post(BASE_URL + 'facturas/guardar', datos_form, function () {
            //se ejecuta cuando recibe respuesta válida
            table.ajax.reload();
            modal_factura_bs.hide();
        })


    });


});



