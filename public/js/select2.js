$(function () {
    $('.plan').select2({
        language: {
            noResults: function() {
                var valor = $(".select2-search__field").val();
                $('#plan_name').val(valor);
                return "<a id='add_plan' class='font-weight-300 add_plan' data-toggle='modal' data-target='#exampleModal' onClick='closeSelect();'>+ Agregar plan</a>";
           }
        },
        
        escapeMarkup: function (markup) {
            return markup;
        },
        placeholder: "Seleccione plan o planes",
        allowClear: true
        // tags: true
    });

});

function closeSelect() {
    $('.plan').select2('close');
    $('#plan_name').val('');
    $('#classes').val('');
    $('#btns_create_plan').addClass('d-none');
}

$('.select2').on("select2:select", function (e) {
    $('.select2-activities').select2('close');
});

