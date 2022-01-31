$(function () {

    let card_buscar = $('#card-buscar');

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
            {data: 'precio_estancia', title: 'Precio estancia'},
            {
                data: 'id',
                orderable: false,
                className: 'text-nowrap',
                width: '5px',
                render: function (data, type, row, meta) {
                    return `
                        <button class="btn btn btn-outline-secondary btn-xs seleccionar">
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
        drawCallback: function (settings) {

        }


    }).on('click', '.seleccionar', function () {
        let tr = $(this).closest('tr');
        let datos = table.row(tr).data();


    });

})
