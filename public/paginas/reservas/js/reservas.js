$(function () {

    const modal_detalles = $('#modal-detalles');
    const modal_detalles_bs = new bootstrap.Modal(modal_detalles[0], {backdrop: 'static'});
    const modal_create_edit = $('#modal-create_edit');
    const modal_create_edit_bs = new bootstrap.Modal(modal_create_edit[0], {backdrop: 'static'});
    const modal_eliminar = $('#modal-eliminar');
    const modal_eliminar_bs = new bootstrap.Modal(modal_eliminar[0], {backdrop: 'static'});
    let id_activo = null;


    $('#habitaciones-tipo').select2({
        width: '100%',
        minimumResultsForSearch: Infinity
    });

    $('#habitaciones-estado').select2({
        width: '100%',
        minimumResultsForSearch: Infinity
    });

    $('#factura-pago').select2({
        width: '100%',
        minimumResultsForSearch: Infinity
    })


    $('#nueva-reserva').on('click', function () {
        id_activo = null;
        modal_habitaciones.find('.modal-title').html('Nueva habitación');
        modal_habitaciones.find('input').val('');
        modal_habitaciones_bs.show();
    });


    let table = $('#tabla-reservas').DataTable({ // el id es la tabla
        ajax: {
            type: 'post',
            url: BASE_URL + 'reservas',
            dataSrc: '',
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
                        <button class="btn btn btn-outline-success btn-xs create_edit">
                            <i class="fa fa-pencil"></i>
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

        modal_detalles.find('.modal-title').html('Reserva # ' + datos.id)
        $('#datos-reserva .numero-reserva').html(datos.id);
        $('#datos-reserva .habitacion-reserva').html(datos.habitacion.numero);
        $('#datos-reserva .fecha-entrada').html(dateFormat(datos.fecha_entrada));
        $('#datos-reserva .fecha-salida').html(dateFormat(datos.fecha_salida));
        $('#datos-reserva .personas-reserva').html(datos.personas);
        $('#datos-reserva .precio-reserva').html(datos.precio + ' euros');
        $('#datos-reserva .late-checkout-reserva').html(datos.late_ckeckout);
        $('#datos-reserva .check-in-reserva').html(datos.timestamp_entrada);
        $('#datos-reserva .check-out-reserva').html(datos.timestamp_salida);


        $('#datos-cliente .dni-cliente-reserva').html(datos.cliente.dni);
        $('#datos-cliente .nombre-cliente-reserva').html(datos.cliente.nombre);
        $('#datos-cliente .apellidos-cliente-reserva').html(datos.cliente.apellidos);
        $('#datos-cliente .telefono-cliente-reserva').html(datos.cliente.telefono);
        $('#datos-cliente .direccion-cliente-reserva').html(datos.cliente.direccion);
        $('#datos-cliente .localidad-cliente-reserva').html(datos.cliente.localidad);
        $('#datos-cliente .cp_postal-cliente-reserva').html(datos.cliente.cod_postal);
        $('#datos-cliente .provincia-cliente-reserva').html(datos.cliente.provincia);
        $('#datos-cliente .pais').html(datos.cliente.pais);

        modal_detalles_bs.show();

        if (datos.timestamp_entrada === null) {
            //console.log('Entrada: ' + datos.timestamp_entrada);

            modal_detalles.on('click', '.check-in-buttom', function () {
                let datos = table.row(tr).data();
                console.log(datos);
                let datos_envio = {
                    id: datos.id //le mandamos el id a PHP
                };


                //petición para guardar los timestamp
                //no entra aqui
                $.post(BASE_URL + 'reservas/guardarcheckin', datos_envio, function () {
                    //console.log(id_activo);

                    modal_detalles_bs.hide();
                    $('#detalles-footer .check-in-buttom').hide();
                })
            })
        }else {
            console.log("entrada: " + datos.timestamp_entrada);
               $('#detalles-footer .check-in-buttom').hide();
            }


        if (datos.timestamp_salida === null) {
            //console.log('Salida: ' + datos.timestamp_salida);

            modal_detalles.on('click', '.check-out-buttom', function () {
                let datos = table.row(tr).data();
                console.log(datos);
                let datos_envio = {
                    id: datos.id //le mandamos el id a PHP
                };


                //petición para guardar los timestamp
                //no entra aqui
                $.post(BASE_URL + 'reservas/guardarcheckout', datos_envio, function () {
                    //console.log(datos.id);
                    //se ejecuta cuando recibe respuesta válida
                    //datos.timestamp_salida = fecha;

                    modal_detalles_bs.hide();
                    $('#detalles-footer .check-out-buttom').hide();


                    //ocultar el modal
                    // modal_detalles_bs.hide();
                })
            })
        }else {
            console.log("salida: " + datos.timestamp_salida);
            $('#detalles-footer .check-out-buttom').hide();

            }

            }).on('click', '.create_edit', function () {
                let tr = $(this).closest('tr');
                let datos = table.row(tr).data();
                modal_create_edit.find('.modal-title').html('Crear / Editar factura')
                $(' .numero-reserva').html(datos.id);
                $(' .habitacion-reserva').html(datos.habitacion.numero);
                // $(' .numero-factura').html(dateFormat(datos.fecha_entrada));
                // $(' .fecha-factura').html(dateFormat(datos.fecha_salida));
                // $(' .personas-reserva').html(datos.personas);
                // $(' .precio-reserva').html(datos.precio + ' euros');
                // $(' .late-checkout-reserva').html(datos.late_ckeckout);
                // $('#datos-reserva .check-in-reserva').html(datos.timestamp_entrada);
                // $('#datos-reserva .check-out-reserva').html(datos.timestamp_salida);

                modal_create_edit_bs.show();
            });


            }).on('click', '.eliminar', function () {
                let tr = $(this).closest('tr');
                let datos = table.row(tr).data();
                id_activo = datos.id;
                modal_eliminar.find('.modal-title-text').html('Eliminar reserva');
                modal_eliminar.find('.mensaje').html(`¿Está seguro de que quiere eliminar la reserva <i class="text-nowrap">${datos.id}</i>?`);
                modal_eliminar_bs.show();
            });

            modal_eliminar.on('click', '.eliminar', function () {
                //enviar los datos al servidor mediante POST (usando AJAX)
                let datos_envio = {
                    id: id_activo
                };
                $.post(BASE_URL + 'reservas/eliminar', datos_envio, function () {
                    //se ejecuta cuando recibe respuesta válida

                    //recargar el datatables
                    table.ajax.reload();
                    //ocultar el modal
                    modal_eliminar_bs.hide();
                })
            });

        modal_create_edit.on('click', '.pagada', function() {
            let datos_envio = {
                id: id_activo //le pasamos el id a PHP
            };

            $.post(BASE_URL + 'reservas/editarfactura', datos_envio, function () {
                //se ejecuta cuando recibe respuesta válida


                //ocultar el modal
                modal_create_edit_bs.hide();
            })


        })



