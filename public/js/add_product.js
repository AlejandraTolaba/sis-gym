function insert(data_plan) {
    var quantity = [];
    console.log(quantity);
    var subtotal = 0;
    var dataToAppend = '<tr id="row'+data_plan[0]+'"><td class="idColumn">'+data_plan[0]+'</td><td>'+data_plan[1]+'-'+data_plan[2]+'</td><td>'+data_plan[3]+'</td><td><input id="td_quantity'+data_product[0]+'" type="number" name="td_quantity[]" class="form-control text-center" required></td><td>$'+data_plan[4]+'</td></tr>';
    
    console.log(dataToAppend);
    if ($('#resultsTableBody > tr').length == 0) {
        $('#resultsTableBody').append(dataToAppend);
    } else {
        var arrayIds = [];
        $('.idColumn').each(function(i, val) {
            arrayIds[$(val).parent().index()] = $(val).html();
        });
        arrayIds.push(data_plan[0])
        arrayIds.sort(function (a, b) {
            return a - b;
        });
        var index = arrayIds.indexOf(data_plan[0]);
        if (index == 0) {
            $('#resultsTableBody > tr').eq(index).before(dataToAppend);
        } else {
            $('#resultsTableBody > tr').eq(index-1).after(dataToAppend);
        }			
    }
}

$('.select2').on("select2:select", function (e) {
    data_product = e.params.data.id.split('_');
    console.log(data_product)
    $('#products_table').removeClass('d-none');
    //$('#table').append('<tr id="row'+data_product[0]+'"><td>'+data_product[0]+'</td><td>'+data_product[1]+'</td><td>'+data_product[2]+'</td><td><input id="td_price_'+ data_product[1] +'" type="number" step="any" name="td_price[]" class="form-control text-center" placeholder="Ingrese precio"></td></tr>');
    insert(data_product);
});

$('.select2_multiple').on("select2:unselect", function (e) {
    data_product = e.params.data.id.split('_');
    $('#row'+data_product[0]).remove();
    if ($("#table tr").length -1 <= 0) {
        $('#products_table').addClass('d-none');
    }
});

var selected = new Array();
$('.plan_id').each(function(index){
    value = $(this).text(); 
    selected.push(value);
});

$('#plans_id').val(selected).trigger('change.select2');

