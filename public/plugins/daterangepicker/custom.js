let common_locale = {
    "separator": " - ",
    "applyLabel": "Aceptar",
    "cancelLabel": "Cancelar",
    "fromLabel": "Del",
    "toLabel": "Al",
    "customRangeLabel": "Personalizado",
    "weekLabel": "W",
    "daysOfWeek": [
        "Do",
        "Lu",
        "Ma",
        "Mi",
        "Ju",
        "Vi",
        "Sa"
    ],
    "monthNames": [
        "Enero",
        "Febrero",
        "Marzo",
        "Abril",
        "Mayo",
        "Junio",
        "Julio",
        "Agosto",
        "Septiembre",
        "Octubre",
        "Noviembre",
        "Diciembre"
    ],
    "firstDay": 1
}

let bootstrap_daterangepicker_locale = {
    "format": "DD/MM/YYYY",
    ...common_locale
};

let bootstrap_daterangepicker_locale_HH_mm = {
    "format": "DD/MM/YYYY HH:mm",
    ...common_locale
};

let bootstrap_daterangepicker_locale_HH_mm_ss = {
    "format": "DD/MM/YYYY HH:mm:ss",
    ...common_locale
};

let bootstrap_daterangepicker_ranges = {
    'Mañana': [moment().add(1, 'day'), moment().add(1, 'day')],
    'Hoy': [moment(), moment()],
    'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
    'Últimos 7 días': [moment().subtract(6, 'days'), moment()],
    'Próximos 7 días': [moment(), moment().add(6, 'days')],
    'Mes actual': [moment().startOf('month'), moment().endOf('month')],
    'Mes anterior': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
}
