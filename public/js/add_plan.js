$('input').on('input', function(index, element){
    var inputs_plans = new Array();
    $('.input-validate').each(function() {
        if($(this).val()!=""){
            inputs_plans.push($(this).val());
        }    
    });
    if (inputs_plans. length >= 2) {
        $('#btns_create_plan').removeClass('d-none');
    }
    else{
        $('#btns_create_plan').addClass('d-none');
    }
    // console.log(inputs_plans.length);
});

$("#btnSavePlan").click(function (e){
    e.preventDefault();
    let plan_name = $('#plan_name').val();
    let plan_classes = $('#classes').val();
    $.ajax({
      url:"/plans/create",
      method:"POST",
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      data: {
          name: plan_name,
          classes: plan_classes
      }, success: function(data) {
            $('#id_plan').val(data);
            console.log($('#id_plan').val());
          }
    });
});

function addOptionPlan( combo) {
    let plan_name = $('#plan_name').val();
    let plan_classes = $('#classes').val();
    let id_plan = $('#id_plan').val();
    let value = id_plan+'_'+plan_name+'_'+plan_classes;
    combo.options[combo.options.length] = new Option(plan_name,value,"defaultSelected");
    $('#plans_table').removeClass('d-none');
    let data_plan = [id_plan, plan_name, plan_classes]
    insert(data_plan);
    //$('#table').append('<tr id="row'+id_plan+'"><td class="idColumn">'+id_plan+'</td></td><td>'+plan_name+'</td><td>'+plan_classes+'</td><td><input id="td_price_'+ id_plan +'" type="number" name="td_price[]" class="form-control" placeholder="Ingrese precio"></td></tr>');
}

function addPlan() {
    var plan_classes = $('#classes').val();
    var id_plan = $('#id_plan').val();
    var plan_name = $('#plan_name').val();
    var value = id_plan+'_'+plan_name+'_'+plan_classes;
    var combo = document.getElementById('plans_id');
    var values = $('#plans_id').val();
    values.push(value);
    // console.log(values);
    addOptionPlan( combo );
    $('#plans_id').val(values).trigger('change.select2');
}

function insert(data_plan) {
    var dataToAppend = '<tr id="row'+data_plan[0]+'"><td class="idColumn">'+data_plan[0]+'</td><td>'+data_plan[1]+'</td><td>'+data_plan[2]+'</td><td><input id="td_price_'+ data_plan[1] +'" type="number" step="any" name="td_price[]" class="form-control text-center" placeholder="Ingrese precio" required></td></tr>';
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

$('.select2_multiple').on("select2:select", function (e) {
    data_plan = e.params.data.id.split('_');
    $('#plans_table').removeClass('d-none');
    //$('#table').append('<tr id="row'+data_plan[0]+'"><td>'+data_plan[0]+'</td><td>'+data_plan[1]+'</td><td>'+data_plan[2]+'</td><td><input id="td_price_'+ data_plan[1] +'" type="number" step="any" name="td_price[]" class="form-control text-center" placeholder="Ingrese precio"></td></tr>');
    insert(data_plan);
});

$('.select2_multiple').on("select2:unselect", function (e) {
    data_plan = e.params.data.id.split('_');
    $('#row'+data_plan[0]).remove();
    if ($("#table tr").length -1 <= 0) {
        $('#plans_table').addClass('d-none');
    }
});

var selected = new Array();
$('.plan_id').each(function(index){
    value = $(this).text(); 
    selected.push(value);
});

$('#plans_id').val(selected).trigger('change.select2');

