$(function () {

    const modal_servicios = $('#modal-servicios');
    const modal_servicios_bs = new bootstrap.Modal(modal_servicios[0], {backdrop: 'static'});
    const modal_eliminar = $('#modal-eliminar');
    const modal_eliminar_bs = new bootstrap.Modal(modal_eliminar[0], {backdrop: 'static'});
    let id_activo = null;


    $('#servicio-estado').select2({
        width: '100%',
        minimumResultsForSearch: Infinity
    });


    $('#nuevo-servicio').on('click', function () {
        id_activo = null;
        modal_servicios.find('.modal-title').html('Nuevo servicio');
        modal_servicios.find('input').val('');
        modal_servicios_bs.show();
    });


    let table = $('#tabla-servicios').DataTable({ // el id es la tabla
        ajax: {
            type: 'post',
            url: BASE_URL + 'servicios',
            dataSrc: '',
        },
        columns: [
            {data: 'nombre', title: 'Nombre'},
            {data: 'plazas', title: 'Plazas'},
            {data: 'precio', title: 'Precio'},
            {data: 'estado', title: 'Estado',
                render: function (data, type, row, meta) {
                    if (data === 'activo') {
                        return `<span class="badge bg-success fs-6">Activo</span>`
                    } else {
                        return `<span class="badge bg-danger fs-6">Inactivo</span>`
                    }
                }
            },
            {data: 'id', orderable: false, className: 'text-nowrap', width: '5px', render: function (data, type, row, meta) {
                    return `
                    <button class="btn btn btn-outline-secondary btn-xs editar">
                        <i class="fa fa-pencil-alt"></i>
                    </button>
                    <button class="btn btn btn-outline-danger btn-xs eliminar">
                        <i class="fa fa-trash"></i>
                    </button>`;
                }},
        ],
        language: datatables_locale,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
        pageLength: 10,
        order: [[1, 'asc'], [2, 'asc']],
        scrollX: true,
        drawCallback: function(settings) {

        }

    }).on('click', '.editar', function () {
        let tr = $(this).closest('tr'); // apunta a la fila a la que pertenece el botón que pulses
        let datos = table.row(tr).data();
        id_activo = datos.id;
        modal_servicios.find('.modal-title').html('Editar servicio');
        $('#servicio-nombre').val(datos.nombre); //lo mete en el formulario
        $('#servicio-plazas').val(datos.plazas);
        $('#servicio-estado').val(datos.estado.toLowerCase()).trigger('change');
        $('#servicio-precio').val(datos.precio);
        modal_servicios_bs.show();

    }).on('click', '.eliminar', function () {
        let tr = $(this).closest('tr');
        let datos = table.row(tr).data();
        id_activo = datos.id;
        modal_eliminar.find('.modal-title-text').html('Eliminar servicio');
        modal_eliminar.find('.mensaje').html(`¿Está seguro de que quiere eliminar el servicio <i class="text-nowrap">${datos.nombre} </i>?`);
        modal_eliminar_bs.show();
    });


    // modal_clientes.find('.aceptar').on('click', function () {
    //
    // })

    modal_servicios.on('hidden.bs.modal', function () {
        limpiarErrores(modal_servicios);
    }).on('click', '.aceptar', function () {
        limpiarErrores(modal_servicios);
        //cogemos los datos del formulario en JSON
        let datos_form = serializeArrayJson('#form-servicios');
        datos_form.id = id_activo

        //enviar los datos al servidor mediante POST (usando AJAX)
        $.post(BASE_URL + 'servicios/guardar', datos_form, function () {
            //se ejecuta cuando recibe respuesta válida

            //recargar el datatables
            table.ajax.reload();
            //ocultar el modal
            modal_servicios_bs.hide();
        }).fail(function(error) {
            mostrarErrores(error, modal_servicios);
        })
    });


    modal_eliminar.on('click', '.eliminar', function () {
        //enviar los datos al servidor mediante POST (usando AJAX)
        let datos_envio = {
            id: id_activo
        };
        $.post(BASE_URL + 'servicios/eliminar', datos_envio, function () {
            //se ejecuta cuando recibe respuesta válida

            //recargar el datatables
            table.ajax.reload();
            //ocultar el modal
            modal_eliminar_bs.hide();
        })
    });



});
