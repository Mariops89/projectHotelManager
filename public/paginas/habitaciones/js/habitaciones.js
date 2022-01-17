$(function () {

    const modal_habitaciones = $('#modal-habitaciones');
    const modal_habitaciones_bs = new bootstrap.Modal(modal_habitaciones[0], {backdrop: 'static'});
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


    $('#nueva-habitacion').on('click', function () {
        id_activo = null;
        modal_habitaciones.find('.modal-title').html('Nueva habitación');
        modal_habitaciones.find('input').val('');
        modal_habitaciones_bs.show();
    });


    let table = $('#tabla-habitaciones').DataTable({ // el id es la tabla
        ajax: {
            type: 'post',
            url: BASE_URL + 'habitaciones',
            dataSrc: '',
        },
        columns: [
            {data: 'numero', title: 'Número'},
            {data: 'tipo.tipo', title: 'Tipo de habitación'},
            {data: 'personas', title: 'Número de personas'},
            {data: 'tipo.precio_baja', title: 'Precio en temporada baja'},
            {data: 'tipo.precio_alta', title: 'Precio en temporada alta'},
            {
                data: 'estado', title: 'Estado', className: 'text-center',
                render: function (data, type, row, meta) {
                    if (data === 'Activa') {
                        return `<span class="badge bg-success fs-6">Activa</span>`
                    } else {
                        return `<span class="badge bg-danger fs-6">Inactiva</span>`
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
        order: [[1, 'asc'], [2, 'asc']],
        scrollX: true,
        drawCallback: function (settings) {

        }


    }).on('click', '.editar', function () {
        let tr = $(this).closest('tr');
        let datos = table.row(tr).data();
        id_activo = datos.id;
        modal_habitaciones.find('.modal-title').html('Editar habitación');
        $('#habitaciones-numero').val(datos.numero);
        $('#habitaciones-tipo').val(datos.id_tipo_habitacion).trigger('change');
        $('#habitaciones-personas').val(datos.personas);
        $('#habitaciones-estado').val(datos.estado.toLowerCase()).trigger('change');
        modal_habitaciones_bs.show();

    }).on('click', '.eliminar', function () {
        let tr = $(this).closest('tr');
        let datos = table.row(tr).data();
        id_activo = datos.id;
        modal_eliminar.find('.modal-title-text').html('Eliminar habitación');
        modal_eliminar.find('.mensaje').html(`¿Está seguro de que quiere eliminar la habtiación <i class="text-nowrap">${datos.numero}</i>?`);
        modal_eliminar_bs.show();
    });


    modal_habitaciones.on('hidden.bs.modal', function () {
        limpiarErrores(modal_habitaciones);
    }).on('click', '.aceptar', function () {
        //cogemos los datos del formulario en JSON
        let datos_form = serializeArrayJson('#form-habitaciones');
        datos_form.id = id_activo
        //enviar los datos al servidor mediante POST (usando AJAX)
        $.post(BASE_URL + 'habitaciones/guardar', datos_form, function () {
            //se ejecuta cuando recibe respuesta válida

            //recargar el datatables
            table.ajax.reload();
            //ocultar el modal
            modal_habitaciones_bs.hide();
        }).fail(function (error) {
            mostrarErrores(error, modal_habitaciones);
        });


        modal_eliminar.on('click', '.eliminar', function () {
            //enviar los datos al servidor mediante POST (usando AJAX)
            let datos_envio = {
                id: id_activo
            };
            $.post(BASE_URL + 'habitaciones/eliminar', datos_envio, function () {
                //se ejecuta cuando recibe respuesta válida

                //recargar el datatables
                table.ajax.reload();
                //ocultar el modal
                modal_eliminar_bs.hide();
            })
        });

    });
});

