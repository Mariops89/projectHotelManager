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


function renderDate(data, type, row, meta) {
    if (data !== null && type !== 'sort') {
        data = moment(data).format('DD/MM/YYYY');
    }
    return data;
}


function renderDatetime(data, type, row, meta) {
    if (data !== null && type !== 'sort') {
        data = moment(data).format('DD/MM/YYYY HH:mm:ss');
    }
    return data;
}

function  dateFormat(date){
    return moment(date).format('DD/MM/YYYY');
}

function  dateTimeFormat(date){
    return moment(date).format('DD/MM/YYYY HH:mm:ss');
}
