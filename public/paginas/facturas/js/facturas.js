$(function () {

    const modal_factura = $('#modal-factura');
    const modal_factura_bs = new bootstrap.Modal(modal_factura[0], {backdrop: 'static'});
    const modal_eliminar = $('#modal-eliminar');
    const modal_eliminar_bs = new bootstrap.Modal(modal_eliminar[0], {backdrop: 'static'});
    let id_activo = null;


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



    let table = $('#tabla-facturas').DataTable({ // el id es la tabla
        ajax: {
            type: 'post',
            url: BASE_URL + 'facturas',
            dataSrc: '',
            data: function (d) {
                let drp = $('#fechas').data('daterangepicker');
                d.inicio = drp.startDate.format('YYYY-MM-DD');
                d.fin = drp.endDate.format('YYYY-MM-DD');
            }
        },
        columns: [
            {data: 'numero', title: 'Factura'},
            {data: 'id_reserva', title: 'Reserva'},
            {data: 'reserva.cliente', title: 'Cliente', className: 'text-nowrap',
                render: function (data, type, row, meta) {
                    return data.dni + ' - ' + data.nombre + ' ' + data.apellidos
                }
            },
            {data: 'fecha', title: 'Fecha factura', render: renderDate},
            {data: 'subtotal', title: 'Subtotal', render: render2Decimales},
            {data: 'iva', title: 'IVA', render: render2Decimales},
            {data: 'total', title: 'Total', render: render2Decimales},
            {data: 'forma_pago', title: 'Forma de pago'},
            {data: 'timestamp_pago', title: 'Fecha de pago',
                render: function (data, type, row, meta) {
                    if (data === null) {
                        return '<span class="badge bg-danger fs-6">Pendiente de pago</span>'
                    } else {
                        if (type !== 'sort') {
                            data = moment(data).format('DD/MM/YYYY HH:mm:ss');
                        }
                        return data;
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
                    <button class="btn btn btn-outline-secondary btn-xs editar">
                        <i class="fa fa-pencil-alt"></i>
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
        order: [0, 'asc'],
        scrollX: true,
        drawCallback: function (settings) {

        }

    }).on('click', '.editar', function () {
        let tr = $(this).closest('tr');
        let datos = table.row(tr).data();
        id_activo = datos.id;

        modal_factura.find('.modal-title').html('Editar factura');
        $('#modal-factura .numero-factura').html(datos.numero);
        $('#modal-factura .numero-reserva').html(datos.reserva.id);
        $('#modal-factura .fecha-factura').html(renderDate(datos.fecha));
        $('#modal-factura .habitacion-reserva').html(datos.reserva.habitacion.numero);
        $('#modal-factura .cliente').html(datos.reserva.cliente.dni + ' - ' + datos.reserva.cliente.nombre + ' ' + datos.reserva.cliente.apellidos);
        if (datos.timestamp_pago === null) {
            $('#modal-factura .pagada').prop('checked', false);
            $('#modal-factura #factura-pago').parent().hide();
        } else {
            $('#modal-factura .pagada').prop('checked', true);
            $('#modal-factura #factura-pago').parent().show();
            $('#modal-factura #factura-pago').val(datos.forma_pago).trigger('change');
        }

        let lineas = '';
        $.each(datos.lineas, function (k, linea) {
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
        $('#tabla-lineas .subtotal').html(parseFloat(datos.subtotal).toFixed(2));
        $('#tabla-lineas .iva').html(parseFloat(datos.iva).toFixed(2));
        $('#tabla-lineas .total').html(parseFloat(datos.total).toFixed(2));


        modal_factura_bs.show();

    }).on('click', '.eliminar', function () {
        let tr = $(this).closest('tr');
        let datos = table.row(tr).data();
        id_activo = datos.id;
        modal_eliminar.find('.modal-title-text').html('Eliminar factura');
        modal_eliminar.find('.mensaje').html(`¿Está seguro de que quiere eliminar la factura <i class="text-nowrap">${datos.numero}</i>?`);
        modal_eliminar_bs.show();
    });


    modal_factura.on('change', '.pagada', function () {
        if ($(this).is(':checked')) {
            $('#factura-pago').parent().show();
        } else {
            $('#factura-pago').parent().hide();
        }
    }).on('click', '.aceptar', function() {
        let datos_form = serializeArrayJson('#form-factura');
        datos_form.id = id_activo;
        $.post(BASE_URL + 'facturas/guardar', datos_form, function () {
            //se ejecuta cuando recibe respuesta válida
            table.ajax.reload();
            modal_factura_bs.hide();
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
