function cajeroFormatter(value,row) {
    return `<button  class="codigo_link btn btn-outline-primary">`+row.cajero.codigo+`</button>`;
}
function direccionFormatter(value,row) {
    return row.cajero.direccion;
}

function observacionFormatter(value,row) {
    //  console.log(row)
    if (row.observacion.nombre == 0) {
        return '';
    }
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

function detallesFormatter(value,row) {
    
    return   ` <button class="btnDelete btn btn-danger">
                <i class="fa fa-trash-alt fa-lg"></i>
                </button>`
}
function observacionTableFormatterO(value,row, index) {
    if (index == 0) {
        return 'Sin Especificar'
    }
    return value;
}


function detallesFormatterO(value,row,index) {
    if(index == 0){
        return ''
    }
    return   ` <button class="btnDeleteO btn btn-danger">
                <i class="fa fa-trash-alt fa-lg"></i>
                </button>`
}