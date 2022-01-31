function serializeArrayJson(formulario) {
    let datos_form = $(formulario).serializeArray();
    let json = {};
    $.each(datos_form, function (k, v) {
        if (v.name.indexOf('[]') === -1) {
            json[v.name] = v.value;
        } else {
            let name = v.name.slice(0, -2);
            if (json[name] === undefined) {
                json[name] = [];
            }
            json[name].push(v.value);
        }
    });

    return json;
}


function limpiarErrores(container) {
    container.find('.error').remove();
    container.find('.border-danger').removeClass('border-danger');
}


function mostrarErrores(error, container) {
    limpiarErrores(container);
    if (error.responseJSON !== undefined) {
        $.each(error.responseJSON.errors, function (name, errors) {
            let element = container.find(`[name="${name}"]`);
            element.addClass('border-danger');
            let html = '';
            $.each(errors, function (k, error) {
                html += `<div class="error text-danger">${error}</div>`
            })
            element.after(html);
        })
    }
}
