$(function () {

    const modal_personal = $('#modal-empleado');
    const modal_personal_bs = new bootstrap.Modal(modal_personal[0], {backdrop: 'static'});
    const modal_eliminar = $('#modal-eliminar');
    const modal_eliminar_bs = new bootstrap.Modal(modal_eliminar[0], {backdrop: 'static'});
    let id_activo = null;

  $('#empleado-tipo').select2({
        width: '100%',
        minimumResultsForSearch: Infinity,
    });


    $('#nuevo-empleado').on('click', function () {
        id_activo = null;
        modal_personal.find('.modal-title').html('Nuevo empleado');
        modal_personal.find('input').val('');
        modal_personal_bs.show();
    });


    let table = $('#tabla-personal').DataTable({ // el id es la tabla
        ajax: {
            type: 'post',
            url: BASE_URL + 'personal',
            dataSrc: '',
        },
        columns: [
            {data: 'dni', title: 'DNI'},
            {data: 'nombre', title: 'Nombre'},
            {data: 'apellidos', title: 'Apellidos'},
            {data: 'telefono', title: 'Teléfono'},
            {data: 'direccion', title: 'Dirección'},
            {data: 'localidad', title: 'Localidad'},
            {data: 'cod_postal', title: 'Código postal'},
            {data: 'provincia', title: 'Provincia'},
            {data: 'pais', title: 'País'},
            {data: 'tipo', title: 'Tipo', className: 'text-capitalize'},
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
        modal_personal.find('.modal-title').html('Editar empleado');
        $('#empleado-dni').val(datos.dni);
        $('#empleado-nombre').val(datos.nombre);
        $('#empleado-apellidos').val(datos.apellidos);
        $('#empleado-telefono').val(datos.telefono);
        $('#empleado-direccion').val(datos.direccion);
        $('#empleado-localidad').val(datos.localidad);
        $('#empleado-cod-postal').val(datos.cod_postal);
        $('#empleado-provincia').val(datos.provincia);
        $('#empleado-pais').val(datos.pais);
        $('#empleado-tipo').val(datos.tipo).trigger('change');
        modal_personal_bs.show();

    }).on('click', '.eliminar', function () {
        let tr = $(this).closest('tr');
        let datos = table.row(tr).data();
        id_activo = datos.id;
        modal_eliminar.find('.modal-title-text').html('Eliminar empleado');
        modal_eliminar.find('.mensaje').html(`¿Está seguro de que quiere eliminar el empleado <i class="text-nowrap">${datos.nombre} ${datos.apellidos}</i>?`);
        modal_eliminar_bs.show();
    });


    // modal_personal.find('.aceptar').on('click', function () {
    //
    // })

    modal_personal.on('hidden.bs.modal', function () {
        limpiarErrores(modal_personal);
    }).on('click', '.aceptar', function () {
        limpiarErrores(modal_personal);
        //cogemos los datos del formulario en JSON
        let datos_form = serializeArrayJson('#form-personal');
        datos_form.id = id_activo;

        //enviar los datos al servidor mediante POST (usando AJAX)
        $.post(BASE_URL + 'personal/guardar', datos_form, function () {
            //se ejecuta cuando recibe respuesta válida

            //recargar el datatables
            table.ajax.reload();
            //ocultar el modal
            modal_personal_bs.hide();
        }).fail(function(error) {
            mostrarErrores(error, modal_personal);
        })
    });


    modal_eliminar.on('click', '.eliminar', function () {
        //enviar los datos al servidor mediante POST (usando AJAX)
        let datos_envio = {
            id: id_activo
        };
        $.post(BASE_URL + 'personal/eliminar', datos_envio, function () {
            //se ejecuta cuando recibe respuesta válida

            //recargar el datatables
            table.ajax.reload();
            //ocultar el modal
            modal_eliminar_bs.hide();
        })
    });



});
