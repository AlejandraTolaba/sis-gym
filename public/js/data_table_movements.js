$(function(){
    $('.data-table-movements').DataTable({
        // responsive: true,
        columnDefs:
            [
                {
                    targets: 5,
                    render: $.fn.dataTable.render.number('.', ',', 2, '$')
                }
            ],
        language: {
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
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        },
        footerCallback: function(row, data, start, end, display) {
            var api = this.api();

            // Remove the formatting to get the integer data for summation
            var intVal = function(i) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '') * 1 :
                    typeof i === 'number' ?
                    i :
                    0;
            };

            totalIncomes = api
                .rows({filter:'applied'})
                .data()
                .filter( function ( value, index ) {
                    return value[3] == 'INGRESO' ? true : false;
                } )
                .pluck(5)
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
            console.log(totalIncomes);

            totalOutcomes = api
                .rows({filter:'applied'})
                .data()
                .filter( function ( value, index ) {
                    return value[3] == 'EGRESO' ? true : false;
            } )
                .pluck(5)
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
            // Total amount calculation
            var total = totalIncomes - totalOutcomes;

            // Set the value to the footer
            $(api
                .column(1)
                .footer())
                .html('<div class="col-md-4 offset-md-8 mb-2 mt-2"><div class="input-group"><div class="input-group-prepend"><div class="input-group-text text-bold">INGRESOS</div></div><input type ="text" readonly value="$'+totalIncomes.toLocaleString("es-ES",{ minimumFractionDigits: 2}) +'" class="form-control bg-white text-bold text-center"/></div></div><div class="col-md-4 offset-md-8 mb-2 mt-2"><div class="input-group"><div class="input-group-prepend"><div class="input-group-text text-bold justify-content-center" style="width: 100px"> EGRESOS </div></div><input type ="text" readonly value="$'+totalOutcomes.toLocaleString("es-ES",{ minimumFractionDigits: 2}) +'" class="form-control bg-white text-bold text-center"/></div></div><div class="col-md-4 offset-md-8 mb-2 mt-2"><div class="input-group"><div class="input-group-prepend"><div class="input-group-text text-bold justify-content-center" style="width: 100px"> TOTAL </div></div><input type ="text" readonly value="$'+total.toLocaleString("es-ES",{ minimumFractionDigits: 2}) +'" class="form-control bg-white text-bold text-center"/></div></div>'
            );
            // $(api.column(3).footer()).html('<p>INGRESOS</p><p>$' + totalIncomes.toLocaleString("es-ES",{ minimumFractionDigits: 2}) + '</p>');
            // $(api.column(4).footer()).html('<p>EGRESOS</p><p>$'  + totalOutcomes.toLocaleString("es-ES",{ minimumFractionDigits: 2}) +'</p>');
            // $(api.column(5).footer()).html('<p>TOTAL </p><p>$' + total.toLocaleString("es-ES",{ minimumFractionDigits: 2}) + '</p>');
        },
    });
});

    