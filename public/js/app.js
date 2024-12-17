$(' div.alert ').not(' .alert-important').delay(3000).fadeOut(1000);

$('.select2').select2({
    language: {
        noResults: function() {
          return "Sin resultado";        
        },
        searching: function() {
          return "Buscando..";
        }
      }
});


