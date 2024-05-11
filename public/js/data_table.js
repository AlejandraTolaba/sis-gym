var lang = {
    "decimal": ",",
    "emptyTable": "No hay información",
    "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
    "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
    "infoPostFix": "",
    "thousands": ".",
    "lengthMenu": "Mostrar _MENU_ Entradas",
    "loadingRecords": "Cargando...",
    "processing": "Procesando...",
    "search": "Filtrar:",
    "zeroRecords": "Sin resultados encontrados",
    "paginate": {
        "first": "Primero",
        "last": "Ultimo",
        "next": "Siguiente",
        "previous": "Anterior"
    }
};

$(document).ready(function() {
    $('.data-table-activities').DataTable({
        language: lang,
        responsive: true,
        ajax: "activities",
        columns: [
            { data: 'id', name:'id'},
            { data: 'name', name:'name'},
            { data: 'state', name:'state'},
            { data: 'action', name:'action', orderable:false, searchable:false},
        ],
    });

    $('.data-table-inscriptions').DataTable({
        language: lang,
        responsive: true,
    });

    $('.data-table-teachers').DataTable({
        language: lang,
        responsive: true,
        ajax: "teachers",
        columns: [
            { data: 'fullname', name:'fullname'},
            { data: 'photo', name:'photo', orderable:false, searchable:false},
            { data: 'dni', name:'dni', orderable:false},
            { data: 'phone_number', name:'phone_number', orderable:false, searchable:false},
            { data: 'state', name:'state', orderable:false},
            { data: 'action', name:'action', orderable:false, searchable:false},
        ],
    });
});