$(function () {

    const modal_tipo_habitacion = $('#modal-tipo_habitacion');
    const modal_tipo_habitacion_bs = new bootstrap.Modal(modal_tipo_habitacion[0], {backdrop: 'static'});
    const modal_eliminar = $('#modal-eliminar');
    const modal_eliminar_bs = new bootstrap.Modal(modal_eliminar[0], {backdrop: 'static'});
    const modal_error = $('#modal-error');
    const modal_error_bs = new bootstrap.Modal(modal_error[0], {backdrop: 'static'});
    let id_activo = null;


    $('#nuevo-tipo').on('click', function () {
        id_activo = null;
        modal_tipo_habitacion.find('.modal-title').html('Nuevo tipo');
        modal_tipo_habitacion.find('input').val('');
        modal_tipo_habitacion_bs.show();
    });

    let table = $('#tabla-tipo_habitacion').DataTable({ // el id es la tabla
        ajax: {
            type: 'post',
            url: BASE_URL + 'tipo_habitaciones',
            dataSrc: '',
        },
        columns: [
            {data: 'tipo', title: 'Tipo'},
            {data: 'precio_alta', title: 'Precio en temporada alta'},
            {data: 'precio_baja', title: 'Precio en temporada baja'},
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
        order: [[1, 'asc'], [2, 'asc']],
        scrollX: true,
        drawCallback: function (settings) {

        }


    }).on('click', '.editar', function () {
        let tr = $(this).closest('tr');
        let datos = table.row(tr).data();
        id_activo = datos.id;
        modal_tipo_habitacion.find('.modal-title').html('Editar tipo');
        $('#tipo_habitacion-tipo').val(datos.tipo);
        $('#tipo_habitacion-precio_alta').val(datos.precio_alta);
        $('#tipo_habitacion-precio_baja').val(datos.precio_baja);
        modal_tipo_habitacion_bs.show();

    }).on('click', '.eliminar', function () {
        let tr = $(this).closest('tr');
        let datos = table.row(tr).data();
        id_activo = datos.id;
        modal_eliminar.find('.modal-title-text').html('Eliminar tipo');
        modal_eliminar.find('.mensaje').html(`¿Está seguro de que quiere eliminar el tipo <i class="text-nowrap">${datos.tipo}</i>?`);
        modal_eliminar_bs.show();
    });


    // modal_clientes.find('.aceptar').on('click', function () {
    //
    // })
    modal_tipo_habitacion.on('hidden.bs.modal', function () {
        limpiarErrores(modal_tipo_habitacion);
    }).on('click', '.aceptar', function () {
        //cogemos los datos del formulario en JSON
        let datos_envio = serializeArrayJson('#form-tipo_habitacion');
        datos_envio.id = id_activo

        //enviar los datos al servidor mediante POST (usando AJAX)
        $.post(BASE_URL + 'tipo_habitaciones/guardar', datos_envio, function () {
            //se ejecuta cuando recibe respuesta válida

            //recargar el datatables
            table.ajax.reload();
            //ocultar el modal
            modal_tipo_habitacion_bs.hide();
        }).fail(function(error) {
            mostrarErrores(error, modal_tipo_habitacion);
        })
    });


    modal_eliminar.on('click', '.eliminar', function () {
        //enviar los datos al servidor mediante POST (usando AJAX)
        let datos_envio = {
            id: id_activo
        };
        $.post(BASE_URL + 'tipo_habitaciones/eliminar', datos_envio, function (respuesta) {
            //se ejecuta cuando recibe respuesta válida
            if (respuesta.borrado) {

                //recargar el datatables
                table.ajax.reload();
                //ocultar el modal
                modal_eliminar_bs.hide();
            } else {
                modal_eliminar_bs.hide();
                modal_error.find('.mensaje').html(`No se puede eliminar un tipo de habitación que haya sido usado`);
                modal_error_bs.show();
            }
        }, 'json')
    });



});

