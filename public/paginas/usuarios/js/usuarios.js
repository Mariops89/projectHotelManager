$(function () {

    const modal_usuarios = $('#modal-usuarios');
    const modal_usuarios_bs = new bootstrap.Modal(modal_usuarios[0], {backdrop: 'static'});
    const modal_eliminar = $('#modal-eliminar');
    const modal_eliminar_bs = new bootstrap.Modal(modal_eliminar[0], {backdrop: 'static'});
    let id_activo = null;

    $('#usuarios-id_personal').select2({
        width: '100%',
        placeholder: 'Seleccione un empleado',
        allowClear: true //para poder deseleccionar
    });


    $('#nuevo-usuario').on('click', function () {
        id_activo = null;
        modal_usuarios.find('.modal-title').html('Nuevo usuario');
        modal_usuarios.find('input').val('');
        modal_usuarios_bs.show();
    });


    let table = $('#tabla-usuarios').DataTable({ // el id es la tabla
        ajax: {
            type: 'post',
            url: BASE_URL + 'usuarios',
            dataSrc: '',
        },
        columns: [
            {data: 'usuario', title: 'Usuario'},
            {data: 'password', title: 'Contraseña'},
            {data: 'personal.nombre', title: 'Persona', defaultContent: 'No asignado'
                /*render: function (data, type, row, meta) {
                    if (data === 1) {
                        return `<span class="badge bg-success fs-6">Empleado</span>`
                    } else if (data === 2) {
                        return `<span class="badge bg-danger fs-6">No empleado</span>`
                    }
                }*/
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
        let tr = $(this).closest('tr');
        let datos = table.row(tr).data();
        id_activo = datos.id;
        modal_usuarios.find('.modal-title').html('Editar cliente');
        $('#usuarios-usuario').val(datos.usuario);
        $('#usuarios-password').val(datos.password);
        $('#usuarios-id_personal').val(datos.id_personal).trigger('change');
        modal_usuarios_bs.show();

    }).on('click', '.eliminar', function () {
        let tr = $(this).closest('tr');
        let datos = table.row(tr).data();
        id_activo = datos.id;
        modal_eliminar.find('.modal-title-text').html('Eliminar usuario');
        modal_eliminar.find('.mensaje').html(`¿Está seguro de que quiere eliminar el usuario <i class="text-nowrap">${datos.usuario}</i>?`);
        modal_eliminar_bs.show();
    });


    // modal_usuarios.find('.aceptar').on('click', function () {
    //
    // })

    modal_usuarios.on('click', '.aceptar', function () {
        //cogemos los datos del formulario en JSON
        let datos_form = serializeArrayJson('#form-usuarios');

        //enviar los datos al servidor mediante POST (usando AJAX)
        let datos_envio = {
            id: id_activo,
            datos: datos_form
        };
        $.post(BASE_URL + 'usuarios/guardar', datos_envio, function () {
            //se ejecuta cuando recibe respuesta válida

            //recargar el datatables
            table.ajax.reload();
            //ocultar el modal
            modal_usuarios_bs.hide();
        })
    });


    modal_eliminar.on('click', '.eliminar', function () {
        //enviar los datos al servidor mediante POST (usando AJAX)
        let datos_envio = {
            id: id_activo
        };
        $.post(BASE_URL + 'usuarios/eliminar', datos_envio, function () {
            //se ejecuta cuando recibe respuesta válida

            //recargar el datatables
            table.ajax.reload();
            //ocultar el modal
            modal_eliminar_bs.hide();
        })
    });



});
