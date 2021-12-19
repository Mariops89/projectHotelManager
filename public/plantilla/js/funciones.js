function serializeArrayJson(formulario) {
    let datos_form = $(formulario).serializeArray();
    let json = {};
    $.each(datos_form, function (k, v) {
        json[v.name] = v.value;
    });

    return json;
}
