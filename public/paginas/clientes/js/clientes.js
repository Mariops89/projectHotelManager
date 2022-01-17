$(function () {

    const modal_clientes = $('#modal-clientes');
    const modal_clientes_bs = new bootstrap.Modal(modal_clientes[0], {backdrop: 'static'});
    const modal_eliminar = $('#modal-eliminar');
    const modal_eliminar_bs = new bootstrap.Modal(modal_eliminar[0], {backdrop: 'static'});
    let id_activo = null;


    $('#nuevo-cliente').on('click', function () {
        id_activo = null;
        modal_clientes.find('.modal-title').html('Nuevo cliente');
        modal_clientes.find('input').val('');
        modal_clientes_bs.show();
    });


    let table = $('#tabla-clientes').DataTable({ // el id es la tabla
        ajax: {
            type: 'post',
            url: BASE_URL + 'clientes',
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
            {data: 'pais', title: 'Pais'},
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
        modal_clientes.find('.modal-title').html('Editar cliente');
        $('#cliente-dni').val(datos.dni);
        $('#cliente-nombre').val(datos.nombre);
        $('#cliente-apellidos').val(datos.apellidos);
        $('#cliente-telefono').val(datos.telefono);
        $('#cliente-direccion').val(datos.direccion);
        $('#cliente-localidad').val(datos.localidad);
        $('#cliente-cod_postal').val(datos.cod_postal);
        $('#cliente-provincia').val(datos.provincia);
        $('#cliente-pais').val(datos.pais);
        modal_clientes_bs.show();

    }).on('click', '.eliminar', function () {
        let tr = $(this).closest('tr');
        let datos = table.row(tr).data();
        id_activo = datos.id;
        modal_eliminar.find('.modal-title-text').html('Eliminar cliente');
        modal_eliminar.find('.mensaje').html(`¿Está seguro de que quiere eliminar el cliente <i class="text-nowrap">${datos.nombre} ${datos.apellidos}</i>?`);
        modal_eliminar_bs.show();
    });


    // modal_clientes.find('.aceptar').on('click', function () {
    //
    // })

    modal_clientes.on('hidden.bs.modal', function () {
        limpiarErrores(modal_clientes);
    }).on('click', '.aceptar', function () {
        //cogemos los datos del formulario en JSON
        let datos_form = serializeArrayJson('#form-clientes');
        datos_form.id = id_activo;

        //enviar los datos al servidor mediante POST (usando AJAX)
        $.post(BASE_URL + 'clientes/guardar', datos_form, function () {
            //se ejecuta cuando recibe respuesta válida

            //recargar el datatables
            table.ajax.reload();
            //ocultar el modal
            modal_clientes_bs.hide();
        }).fail(function(error) {
            mostrarErrores(error, modal_clientes);
        })
    });


    modal_eliminar.on('click', '.eliminar', function () {
        //enviar los datos al servidor mediante POST (usando AJAX)
        let datos_envio = {
            id: id_activo
        };
        $.post(BASE_URL + 'clientes/eliminar', datos_envio, function () {
            //se ejecuta cuando recibe respuesta válida

            //recargar el datatables
            table.ajax.reload();
            //ocultar el modal
            modal_eliminar_bs.hide();
        })
    });



});
