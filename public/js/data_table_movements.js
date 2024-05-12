$(function(){
    // function getBase64FromImageUrl(url) {
    //     var img = new Image();
    //         img.crossOrigin = "anonymous";
    //     img.onload = function () {
    //         var canvas = document.createElement("canvas");
    //         canvas.width =this.width;
    //         canvas.height =this.height;
    //         var ctx = canvas.getContext("2d");
    //         ctx.drawImage(this, 0, 0);
    //         var dataURL = canvas.toDataURL("image/png");
    //         return dataURL.replace(/^data:image\/(png|jpg);base64,/, "");
    //     };
    //     img.src = url;
    // }
    $('.data-table-movements').DataTable({
        responsive: true,
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
            "search": "Filtrar:",
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
            // $(api
            //     .column(1)
            //     .footer())
            //     .html('<div class="col-md-4 offset-md-8 mb-2 mt-2"><div class="input-group"><div class="input-group-prepend"><div class="input-group-text text-bold">INGRESOS</div></div><input type ="text" readonly value="$'+totalIncomes.toLocaleString("es-ES",{ minimumFractionDigits: 2}) +'" class="form-control bg-white text-bold text-center"/></div></div><div class="col-md-4 offset-md-8 mb-2 mt-2"><div class="input-group"><div class="input-group-prepend"><div class="input-group-text text-bold justify-content-center" style="width: 100px"> EGRESOS </div></div><input type ="text" readonly value="$'+totalOutcomes.toLocaleString("es-ES",{ minimumFractionDigits: 2}) +'" class="form-control bg-white text-bold text-center"/></div></div><div class="col-md-4 offset-md-8 mb-2 mt-2"><div class="input-group"><div class="input-group-prepend"><div class="input-group-text text-bold justify-content-center" style="width: 100px"> TOTAL </div></div><input type ="text" readonly value="$'+total.toLocaleString("es-ES",{ minimumFractionDigits: 2}) +'" class="form-control bg-white text-bold text-center"/></div></div>'
            // );
            $(api.column(3).footer()).html('<p>INGRESOS</p><p>$' + totalIncomes.toLocaleString("es-ES",{ minimumFractionDigits: 2}) + '</p>');
            $(api.column(4).footer()).html('<p>EGRESOS</p><p>$'  + totalOutcomes.toLocaleString("es-ES",{ minimumFractionDigits: 2}) +'</p>');
            $(api.column(5).footer()).html('<p>TOTAL </p><p>$' + total.toLocaleString("es-ES",{ minimumFractionDigits: 2}) + '</p>');
        },
        // "lengthChange": false, "autoWidth": false,
        // dom: 'Bfrtip',
        buttons: [{ 
            extend: 'pdfHtml5',
            //    download: 'open',
            //  text: 'Generar PDF',
            footer: true,
            title: 'Reporte de Movimientos',
            text: '<i class="fa fa-file-pdf"></i> Generar PDF',
            className: 'btn btn-danger',
            pageSize: 'A4',
            filename: 'Reporte de Movimientos',
            extension: '.pdf',

            customize: function (doc) {
                console.log(doc);
                var colCount = new Array();
                $('#example1').find('tbody tr:first-child td').each(function(){
                    if($(this).attr('colspan')){
                        for(var i=1;i<=$(this).attr('colspan');$i++){
                            colCount.push('*');
                        }
                    }else{ colCount.push('*'); }
                });
                doc.content[1].table.widths = colCount;
                //Remove the title created by datatTables
                doc.content.splice(0,1);
                //Create a date string that we use in the footer. Format is dd-mm-yyyy
                var now = new Date();
                var jsDate = now.getDate()+'/'+(now.getMonth()+1)+'/'+now.getFullYear();
                var logo = 'data:image/jpeg;base64,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';
                // A documentation reference can be found at
                // https://github.com/bpampuch/pdfmake#getting-started
                // Set page margins [left,top,right,bottom] or [horizontal,vertical]
                // or one number for equal spread
                // It's important to create enough space at the top for a header !!!
                doc.pageMargins = [20,60,20,30];
                // Set the font size fot the entire document
                doc.defaultStyle.fontSize = 10;
                // Set the fontsize for the table header
                doc.styles.tableHeader.fontSize = 10;
                doc.defaultStyle.alignment = 'center';
                // Create a header object with 3 columns
                // Left side: Logo
                // Middle: brandname
                // Right side: A document title
                doc['header']=(function() {
                    return {
                        columns: [
                            {
                                image: logo,
                                width: 30
                            },
                            {
                                alignment: 'center',
                                color: '#5D6975',
                                // italics: true,
                                text: 'Reporte de Movimientos',
                                fontSize: 18,
                                margin: [10,0]
                            },
                        ],
                        margin: 20
                    }
                });
                doc.styles.tableHeader = {
                    bold: true,
                    margin: 3,
                    color: "white",
                    fillColor: "#5D6975"
                },

                doc.styles.tableBodyOdd = {
                    fillColor: "white",
                },

                doc.styles.tableFooter = {
                    bold: true,
                    margin: 5,
                    color: "white",
                    fillColor: "#5D6975"
                },
                // Create a footer object with 2 columns
                // Left side: report creation date
                // Right side: current page and total pages
                doc['footer']=(function(page, pages) {
                    console.log(page, pages);
                    return {
                        columns: [
                            {
                                alignment: 'left',
                                text: ['Creado el: ', { text: jsDate.toString() }]
                            },
                            {
                                alignment: 'right',
                                text: ['Página ', { text: page.toString() },	' de ',	{ text: pages.toString() }]
                            }
                        ],
                        margin: [20, 0]
                    }
                });
                
                // Change dataTable layout (Table styling)
                // To use predefined layouts uncomment the line below and comment the custom lines below
                doc.content[0].layout = 'lightHorizontalLines'; // noBorders , headerLineOnly
                // var objLayout = {};
                // objLayout['hLineWidth'] = function(i) { return .5; };
                // objLayout['vLineWidth'] = function(i) { return .5; };
                // objLayout['hLineColor'] = function(i) { return '#aaa'; };
                // objLayout['vLineColor'] = function(i) { return '#aaa'; };
                // objLayout['paddingLeft'] = function(i) { return 4; };
                // objLayout['paddingRight'] = function(i) { return 4; };
                // doc.content[0].layout = objLayout;
            }
        }],
    }).buttons().container().appendTo('.card-header .col-md-6:eq(-1)');
});

    