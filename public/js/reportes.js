function cajeroFormatter(value,row) {
    return `<button  class="codigo_link btn btn-outline-primary">`+row.cajero.codigo+`</button>`;
}
function direccionFormatter(value,row) {
    return row.cajero.direccion;
}

function observacionFormatter(value,row) {
    return row.observacion.nombre
    
}

function fechaFormatter(value, row) {
    return moment(value).format('LL')
}

function buscar(data,text ) {
    return data.filter(function (row) {
        
        return row.cajero.codigo.toString().startsWith(text)
        
      })
}


// function detallesFormatter(value, row) {
//     return `<button class="btn detalles btn-primary">Detalles</button>`
// }





// data-toggle="modal" data-target="#modal_detalles_reporte"