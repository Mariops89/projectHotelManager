$(function () {

    let card_buscar = $('#card-buscar');
    let card_cliente = $('#card-cliente');
    const modal_confirmacion = $('#modal-confirmacion');
    const modal_modal_confirmacion_bs = new bootstrap.Modal(modal_confirmacion[0], {backdrop: 'static'});
    const modal_clientes = $('#modal-clientes');
    const modal_clientes_bs = new bootstrap.Modal(modal_clientes[0], {backdrop: 'static'});

    let id_cliente;
    let habitacion_activa;

    $('#reserva-fechas').daterangepicker({
        locale: bootstrap_daterangepicker_locale
    });

    $('#reserva-tipo-habitacion').select2({
        width: '100%',
        minimumResultsForSearch: Infinity,
        placeholder: 'Seleccione uno o varios tipos'
    });


    $('#buscar').on('click', function () {
        limpiarErrores(card_buscar)
        card_cliente.hide();
        $('#cliente-no-encontrado').hide();
        $('#datos-cliente').hide();
        //cogemos los datos del formulario en JSON
        let datos_form = serializeArrayJson('#form-buscar');
        //enviar los datos al servidor mediante POST (usando AJAX)
        $.post(BASE_URL + 'reservas/buscar-disponibles', datos_form, function (habitaciones) {
            table.clear().rows.add(habitaciones).draw();
        }, 'json').fail(function (error) {
            mostrarErrores(error, card_buscar);
        });
    });


    let table = $('#tabla-habitaciones-disponibles').DataTable({ // el id es la tabla
        columns: [
            {data: 'numero', title: 'Habitación'},
            {data: 'tipo.tipo', title: 'Tipo de habitación'},
            {data: 'personas', title: 'Número de personas'},
            {data: 'precio_estancia', title: 'Precio estancia', render: euros},
            {
                data: 'id',
                orderable: false,
                className: 'text-nowrap',
                width: '5px',
                render: function (data, type, row, meta) {
                    return `
                        <button class="btn btn btn-outline-secondary btn-xs seleccionar fs-6">
                            <i class="far fa-calendar-check"></i> Seleccionar
                        </button>`;
                }
            },
        ],
        language: datatables_locale,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
        pageLength: 10,
        order: [[1, 'asc'], [2, 'asc']],
        scrollX: true,
        select: {
            style: 'single',
            selector: false
        },
        drawCallback: function (settings) {

        }

    }).on('click', '.seleccionar', function () {
        let tr = $(this).closest('tr');
        habitacion_activa = table.row(tr).data();
        table.rows(tr).select();
        $('#reserva-cliente-dni').val('');
        card_cliente.show();
    });


    $('#buscar-cliente').on('click', function () {
        $('#cliente-no-encontrado').hide();
        $('#datos-cliente').hide();
        let datos_form = {
            dni: $('#reserva-cliente-dni').val()
        };
        $.post(BASE_URL + 'reservas/buscar-cliente', datos_form, function (cliente) {
                if (cliente === null) {
                    $('#cliente-no-encontrado').show();
                } else {
                    id_cliente = cliente.id;
                    $('#datos-cliente .dni').html(cliente.dni);
                    $('#datos-cliente .nombre').html(cliente.nombre);
                    $('#datos-cliente .apellidos').html(cliente.apellidos);
                    $('#datos-cliente .telefono').html(cliente.telefono);
                    $('#datos-cliente .direccion').html(cliente.direccion);
                    $('#datos-cliente .cp').html(cliente.cod_postal);
                    $('#datos-cliente .localidad').html(cliente.localidad);
                    $('#datos-cliente .provincia').html(cliente.provincia);
                    $('#datos-cliente .pais').html(cliente.pais);
                    $('#datos-cliente').show();
                }
            }, 'json').fail(function (error) {
            mostrarErrores(error, card_buscar);
        });
    });


    $('#confirmar-reserva').on('click', function () {
        $('#cliente-no-encontrado').hide();
        $('#datos-cliente').hide();
        let datos_form = {
            id_cliente: id_cliente,
            id_habitacion: habitacion_activa.id,
            precio: habitacion_activa.precio_estancia,
            personas: $('#reserva-personas').val(),
            fechas: $('#reserva-fechas').val(),
        };
        $.post(BASE_URL + 'reservas/confirmar', datos_form, function () {
            modal_modal_confirmacion_bs.show();
        });
    });


    $('#nuevo-cliente').on('click', function () {
        modal_clientes.find('.modal-title').html('Nuevo cliente');
        modal_clientes.find('input').val('');
        modal_clientes_bs.show();
    });


    modal_clientes.on('hidden.bs.modal', function () {
        limpiarErrores(modal_clientes);
    }).on('click', '.aceptar', function () {
        //cogemos los datos del formulario en JSON
        let datos_form = serializeArrayJson('#form-clientes');

        //enviar los datos al servidor mediante POST (usando AJAX)
        $.post(BASE_URL + 'clientes/guardar', datos_form, function () {
            //se ejecuta cuando recibe respuesta válida
            $('#reserva-cliente-dni').val(datos_form.dni);
            $('#buscar-cliente').click();

            //ocultar el modal
            modal_clientes_bs.hide();

        }).fail(function(error) {
            mostrarErrores(error, modal_clientes);
        })
    });

})
