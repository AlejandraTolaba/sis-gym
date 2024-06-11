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
        // ajax: "activities",
        // columns: [
        //     { data: 'id', name:'id'},
        //     { data: 'name', name:'name'},
        //     { data: 'state', name:'state'},
        //     { data: 'action', name:'action', orderable:false, searchable:false},
        // ],
    });

    $('.data-table-inscriptions').DataTable({
        language: lang,
        responsive: true,
        autoWidth: false,
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

    $('.data-table-students').DataTable({
        language: lang,
        responsive: true,
        // ajax: "students",
        // columns: [
        //     { data: 'fullname', name:'fullname'},
        //     { data: 'photo', name:'photo', orderable:false, searchable:false},
        //     { data: 'dni', name:'dni', orderable:false},
        //     { data: 'phone_number', name:'phone_number', orderable:false, searchable:false},
        //     { data: 'state', name:'state', orderable:false},
        //     { data: 'balance', name:'balance'},
        //     { data: 'action', name:'action', orderable:false, searchable:false},
        // ],
    });
    var id = $('.data-table-act-inscriptions').attr("data-id");
    // console.log(id);

    $('.data-table-act-inscriptions').DataTable({
        language: lang,
        autoWidth: false,
        responsive: true,
        ajax: +id,
        columns: [
            { data: 'activity', name:'activity'},
            { data: 'plan', name:'plan', orderable:false},
            { data: 'expiration', name:'expiration'},
            { data: 'classes', name:'classes', orderable:false, searchable:false},
            { data: 'balance', name:'balance'},
            { data: 'state', name:'state', orderable:false},
            { data: 'action', name:'action', orderable:false, searchable:false},
        ],
    });
    $('.data-table-bodycheck').DataTable({
        language: lang,
        autoWidth: false,
        responsive: true,
        searchable: false,
        columnDefs:[{
            targets: "_all",
            searchable: false,
            orderable: false
        }],
    });
    $('.data-table-products').DataTable({
        language: lang,
        responsive: true,
        //ajax: "products",
        // columns: [
        //     { data: 'code', name:'code'},
        //     { data: 'name', name:'name'},
        //     { data: 'stock', name:'stock'},
        //     { data: 'price', name:'price'},
        //     { data: 'action', name:'action', orderable:false, searchable:false},
        // ],
    });
    $('.data-table-users').DataTable({
        language: lang,
        responsive: true,
        ajax: "users",
        columns: [
            { data: 'name', name:'name'},
            { data: 'email', name:'email', orderable:false, searchable:false},
            { data: 'type', name:'type', orderable:false},
            { data: 'action', name:'action', orderable:false, searchable:false},
        ],
    });
});