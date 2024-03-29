$(function () {

    const modal_incidencias = $('#modal-incidencias');
    const modal_incidencias_bs = new bootstrap.Modal(modal_incidencias[0], {backdrop: 'static'});
    const modal_eliminar = $('#modal-eliminar');
    const modal_eliminar_bs = new bootstrap.Modal(modal_eliminar[0], {backdrop: 'static'});
    let id_activo = null;
    let numero = null;


    $('#fechas').daterangepicker({
        locale: bootstrap_daterangepicker_locale,
        ranges: bootstrap_daterangepicker_ranges,
        startDate: moment().startOf('month'),
        endDate: moment().endOf('month')
        // alwaysShowCalendars: true

    }).on('apply.daterangepicker', function(ev, picker) {
        table.ajax.reload();
    });

    $('#incidencia-habitacion').select2({
        width: '100%',
        placeholder:'Seleccione la habitación',
    });

    $('#incidencia-tipo').select2({
        width: '100%',
        minimumResultsForSearch: Infinity,
        placeholder:'Seleccione el tipo de incidencia',
    });

    $('#nueva-incidencia').on('click', function () {
        id_activo = null;
        modal_incidencias.find('.modal-title').html('Nueva incidencia');
        modal_incidencias.find('input').val('');
        modal_incidencias.find('textarea').val('');
        $('#incidencia-acciones').html('');
        modal_incidencias_bs.show();
    });


    let table = $('#tabla-incidencias').DataTable({ // el id es la tabla
        ajax: {
            type: 'post',
            url: BASE_URL + 'incidencias',
            dataSrc: '',
            data: function (d) {
                let drp = $('#fechas').data('daterangepicker');
                d.inicio = drp.startDate.format('YYYY-MM-DD 00:00:00');
                d.fin = drp.endDate.format('YYYY-MM-DD 23:59:59');
            }
        },
        columns: [
            {
                data: 'Tipo', title: 'Urgencia',
                render: function (data, type, row, meta) {
                    if (data === 'urgente'){ // html
                        if (type === 'sort') {
                            return 1;
                        }
                        return '<span class="badge bg-danger fs-6">Urgente</span>'
                    } else if (data === 'moderado'){
                        if (type === 'sort') {
                            return 2;
                        }
                        return '<span class="badge bg-warning fs-6">Moderada</span>'
                    } else if (data === 'no_urgente'){
                        if (type === 'sort') {
                            return 3;
                        }
                        return '<span class="badge bg-success fs-6">No urgente</span>'
                    }
                },
            },
            {data: 'habitacion.numero', title: 'Habitación'},
            {data: 'descripcion', title: 'Descripción'},
            {data: 'fecha_notificacion', title: 'Fecha de notificación', render: renderDatetime},
            {data: 'personal', title: 'Atendida',
                render: function (data, type, row, meta) {
                    if (data === null) {
                        return '<span class="badge bg-warning fs-6">Sin atender</span>'
                    } else {
                        return data.nombre + ' ' + data.apellidos;
                    }
                }
            },
            {data: 'fecha_resolucion', title: 'Fecha de resolución', render: renderDatetime},
            {data: 'id', orderable: false, className: 'text-nowrap', width: '5px',
                render: function (data, type, row, meta) {
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
        order: [[3, 'asc']],
        scrollX: true,
        drawCallback: function(settings) {

        }

    }).on('click', '.editar', function () {
        let tr = $(this).closest('tr'); // apunta a la fila a la que pertenece el botón que pulses
        let datos = table.row(tr).data();
        id_activo = datos.id;
        modal_incidencias.find('.modal-title').html('Editar incidencia');
        $('#incidencia-tipo').val(datos.Tipo).trigger('change'); //lo mete en el formulario
        $('#incidencia-descripcion').val(datos.descripcion);
        //$('#incidencia-id_personal').val(datos.id_personal.toLowerCase()).trigger('change');
        $('#incidencia-habitacion').val(datos.id_habitacion).trigger('change');
        // $('#incidencia-fecha_notificacion').val(datos.fecha_notificacion);
        // $('#incidencia-fecha_resolucion').val(datos.fecha_resolucion);
        $('#incidencia-detalles').val(datos.detalles);
        $('#incidencia-acciones').html(datos.acciones);

        modal_incidencias_bs.show();

    }).on('click', '.eliminar', function () {
        let tr = $(this).closest('tr');
        let datos = table.row(tr).data();
        id_activo = datos.id;
        modal_eliminar.find('.modal-title-text').html('Eliminar incidencia');
        modal_eliminar.find('.mensaje').html(`¿Está seguro de que quiere eliminar la incidencia de la habitación <i class="text-nowrap">${datos.habitacion.numero}</i>: <i class="text-nowrap">${datos.descripcion}</i>?`);
        modal_eliminar_bs.show();
    });


    // modal_clientes.find('.aceptar').on('click', function () {
    //
    // })

    modal_incidencias.on('hidden.bs.modal', function () {
        limpiarErrores(modal_incidencias);
    }).on('click', '.aceptar', function () {
        limpiarErrores(modal_incidencias);
        //cogemos los datos del formulario en JSON
        let datos_form = serializeArrayJson('#form-incidencias');
        datos_form.id = id_activo
        //enviar los datos al servidor mediante POST (usando AJAX)
        $.post(BASE_URL + 'incidencias/guardar', datos_form, function () {
            //se ejecuta cuando recibe respuesta válida

            //recargar el datatables
            table.ajax.reload();
            //ocultar el modal
            modal_incidencias_bs.hide();
        }).fail(function(error) {
            mostrarErrores(error, modal_incidencias);
        })
    });


    modal_eliminar.on('click', '.eliminar', function () {
        //enviar los datos al servidor mediante POST (usando AJAX)
        let datos_envio = {
            id: id_activo
        };
        $.post(BASE_URL + 'incidencias/eliminar', datos_envio, function () {
            //se ejecuta cuando recibe respuesta válida

            //recargar el datatables
            table.ajax.reload();
            //ocultar el modal
            modal_eliminar_bs.hide();
        })
    });



});
