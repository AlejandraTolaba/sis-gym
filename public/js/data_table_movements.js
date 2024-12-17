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
    var from = $('#from').val();
    from = $.format.date(from+'00:00:00', "dd/MM/yyyy");
    var to = $('#to').val();
    to = $.format.date(to+'00:00:00', "dd/MM/yyyy");
    var text = '';
    
    if (from == to) {
        text = 'Reporte de movimientos del '+from;
    }
    else{
        text = 'Reporte de movimientos desde el '+from+' hasta el '+to;
    }
    $('.data-table-movements').DataTable({
        responsive: true,
        autoWidth: false,
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
            /******************************************************************************
                                                CONTADO
            *******************************************************************************/
            totalIncomesC = api
                .rows({filter:'applied'})
                .data()
                .filter( function ( value, index ) {
                    return (value[3] == 'INGRESO' && value[4] == 'Contado') ? true : false;
                } )
                .pluck(5)
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
            
            totalOutcomesC = api
                .rows({filter:'applied'})
                .data()
                .filter( function ( value, index ) {
                    return (value[3] == 'EGRESO' && value[4] == 'Contado') ? true : false;
            } )
                .pluck(5)
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
            // Total amount calculation
            var totalC = totalIncomesC - totalOutcomesC;

            /******************************************************************************
                                                DEBITO AUTOMATICO
            *******************************************************************************/
            totalIncomesDA = api
            .rows({filter:'applied'})
            .data()
            .filter( function ( value, index ) {
                return (value[3] == 'INGRESO' && value[4] == 'Débito automático') ? true : false;
            } )
            .pluck(5)
            .reduce(function (a, b) {
                return intVal(a) + intVal(b);
            }, 0);
        
            totalOutcomesDA = api
                .rows({filter:'applied'})
                .data()
                .filter( function ( value, index ) {
                    return (value[3] == 'EGRESO' && value[4] == 'Débito automático') ? true : false;
            } )
                .pluck(5)
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
            // Total amount calculation
            var totalDA = totalIncomesDA - totalOutcomesDA;

            
            /******************************************************************************
                                                TARJETA DE DÉBITO
            *******************************************************************************/
            totalIncomesTD = api
            .rows({filter:'applied'})
            .data()
            .filter( function ( value, index ) {
                return (value[3] == 'INGRESO' && value[4] == 'Tarjeta de débito') ? true : false;
            } )
            .pluck(5)
            .reduce(function (a, b) {
                return intVal(a) + intVal(b);
            }, 0);
        
            totalOutcomesTD = api
                .rows({filter:'applied'})
                .data()
                .filter( function ( value, index ) {
                    return (value[3] == 'EGRESO' && value[4] == 'Tarjeta de débito') ? true : false;
            } )
                .pluck(5)
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
            // Total amount calculation
            var totalTD = totalIncomesTD - totalOutcomesTD;

            /******************************************************************************
                                                TARJETA DE CRÉDITO
            *******************************************************************************/
            totalIncomesTC = api
            .rows({filter:'applied'})
            .data()
            .filter( function ( value, index ) {
                return (value[3] == 'INGRESO' && value[4] == 'Tarjeta de crédito') ? true : false;
            } )
            .pluck(5)
            .reduce(function (a, b) {
                return intVal(a) + intVal(b);
            }, 0);
        
            totalOutcomesTC = api
                .rows({filter:'applied'})
                .data()
                .filter( function ( value, index ) {
                    return (value[3] == 'EGRESO' && value[4] == 'Tarjeta de crédito') ? true : false;
            } )
                .pluck(5)
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
            // Total amount calculation
            var totalTC = totalIncomesTC - totalOutcomesTC;
            /*********************************************************************************************************/
            totalIncomes = api
            .rows({filter:'applied'})
            .data()
            .filter( function ( value, index ) {
                return (value[3] == 'INGRESO') ? true : false;
            } )
            .pluck(5)
            .reduce(function (a, b) {
                return intVal(a) + intVal(b);
            }, 0);
        
            totalOutcomes = api
                .rows({filter:'applied'})
                .data()
                .filter( function ( value, index ) {
                    return (value[3] == 'EGRESO') ? true : false;
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
            $(api.column(1).footer()).html('<p><b>$' + totalIncomes.toLocaleString("es-ES",{ minimumFractionDigits: 2}) + '</b></p>');
            $(api.column(3).footer()).html('<p><b>$'  + totalOutcomes.toLocaleString("es-ES",{ minimumFractionDigits: 2}) +'</b></p>');
            $(api.column(5).footer()).html('<p><b>$'+total.toLocaleString("es-ES",{ minimumFractionDigits: 2})+'</b></p>');
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
            orientation: 'landscape',
            filename: 'Reporte de Movimientos',
            extension: '.pdf',

            customize: function (doc) {
                // console.log(doc.content[1].table.body[doc.content[1].table.body.length-1][5]);
                doc.content[1].table.body[doc.content[1].table.body.length-1][0].color = '#155724';
                doc.content[1].table.body[doc.content[1].table.body.length-1][0].fillColor ='#d4edda';
                doc.content[1].table.body[doc.content[1].table.body.length-1][1].color = '#155724';
                doc.content[1].table.body[doc.content[1].table.body.length-1][1].fillColor ='#d4edda';
                doc.content[1].table.body[doc.content[1].table.body.length-1][2].color = '#721c24';
                doc.content[1].table.body[doc.content[1].table.body.length-1][2].fillColor ='#f8d7da';
                doc.content[1].table.body[doc.content[1].table.body.length-1][3].color = '#721c24';
                doc.content[1].table.body[doc.content[1].table.body.length-1][3].fillColor ='#f8d7da';
                doc.content[1].table.body[doc.content[1].table.body.length-1][4].color = '#383d41';
                doc.content[1].table.body[doc.content[1].table.body.length-1][4].fillColor ='#e2e3e5';
                doc.content[1].table.body[doc.content[1].table.body.length-1][5].color = '#383d41';
                doc.content[1].table.body[doc.content[1].table.body.length-1][5].fillColor ='#e2e3e5';
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
                doc.pageMargins = [30,90,30,30];
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
                                width: 35
                            },
                            {
                                alignment: 'left',
                                color: '#5D6975',
                                bold: true,
                                // italics: true,
                                text: text,
                                fontSize: 14,
                                margin: [10,6,10,5]
                            },
                        ],
                        margin: [30,50,30,40]
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
                    // color: "white",
                    // fillColor: "#5D6975"
                },
                // Create a footer object with 2 columns
                // Left side: report creation date
                // Right side: current page and total pages
                doc['footer']=(function(page, pages) {
                    // console.log(page, pages);
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

    