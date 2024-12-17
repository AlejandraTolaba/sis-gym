function getValue(id, value) {
    data = id.split('_');
    // console.log(data);
    p_id = data[0];
    p_price = data[1];
    subtotal = p_price*value;
    $('#subtotal_'+p_id).text(subtotal.toFixed(2));
    getTotal();
}

function getTotal(){
    var data = [];
    $("td.subtotal").each(function(){
        data.push(parseFloat($(this).text()));
        // console.log(data);
    });
    var sum = data.reduce(function(a,b){ return a+b; },0);
    // console.log(sum);
    $('#input_total').val(sum.toFixed(2));
}

function insert(data_product) {
    var dataToAppend = '<tr id="row'+data_product[0]+'"><td class="idColumn">'+data_product[0]+'</td><td>'+data_product[1]+'-'+data_product[2]+'</td><td>'+data_product[3]+'</td><td><input id="'+data_product[0]+'_'+data_product[4]+'" type="number" name="td_quantity[]" onChange = "getValue(id, this.value)" class="form-control text-center quantity" min=1 max="'+data_product[3]+'" required></td><td>'+data_product[4]+'</td><td id="subtotal_'+data_product[0]+'" class="subtotal">0</td></tr>';
    // $('input.quantity').attr('max', data_product[3].toString());
    if ($('#resultsTableBody > tr').length == 0) {
        $('#resultsTableBody').append(dataToAppend);
    } else {
        var arrayIds = [];
        $('.idColumn').each(function(i, val) {
            arrayIds[$(val).parent().index()] = $(val).html();
        });
        arrayIds.push(data_product[0])
        arrayIds.sort(function (a, b) {
            return a - b;
        });
        var index = arrayIds.indexOf(data_product[0]);
        if (index == 0) {
            $('#resultsTableBody > tr').eq(index).before(dataToAppend);
        } else {
            $('#resultsTableBody > tr').eq(index-1).after(dataToAppend);
        }			
    }
}

$('.select2_multiple').on("select2:select", function (e) {
    data_product = e.params.data.id.split('_');
    // console.log(data_product)
    $('#products_table').removeClass('d-none');
    //$('#table').append('<tr id="row'+data_product[0]+'"><td>'+data_product[0]+'</td><td>'+data_product[1]+'</td><td>'+data_product[2]+'</td><td><input id="td_price_'+ data_product[1] +'" type="number" step="any" name="td_price[]" class="form-control text-center" placeholder="Ingrese precio"></td></tr>');
    insert(data_product);
});

$('.select2_multiple').on("select2:unselect", function (e) {
    data_product = e.params.data.id.split('_');
    sub = $('#subtotal_'+data_product[0]).text();
    // array_id.pop(data_product[0]);
    $('#row'+data_product[0]).remove();
    // console.log(sub);
    total = $('#input_total').val();
    total -= parseFloat(sub);
    // console.log(total);
    $('#input_total').val(total.toFixed(2));
    if ($("#table tr").length -1 <= 1) {
        $('#products_table').addClass('d-none');
    }
});



