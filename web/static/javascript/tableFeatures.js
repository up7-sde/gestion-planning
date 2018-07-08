$(document).ready(function() {
    //console.log(data[0]["action"]);
    $("#table").DataTable({
        "order": [[ 1, "desc" ]],
        columnDefs: [
            { targets: [0], orderable: false}
        ],
        scrollX: true,
        language: {
            "decimal": ",",
            "emptyTable":     "Pas de données",
            "info":           "Observations _START_ à _END_ sur _TOTAL_",
            "infoEmpty":      "Observations 0 à 0 sur 0",
            "infoFiltered":   "",
            "infoPostFix":    "",
            "thousands":      ",",
            "lengthMenu":     "Voir _MENU_ observations",
            "loadingRecords": "Chargement...",
            "processing":     "Chargement...",
            "search":         "",
            "zeroRecords":    "Aucun résultat trouvé",
            "paginate": {
                "first":      "Première",
                "last":       "Dernière",
                "next":       "Suivante",
                "previous":   "Précédente"
            },
            "aria": {
                "sortAscending":  ": activate to sort column ascending",
                "sortDescending": ": activate to sort column descending"
            }
        },
        
        dom:"<'row'<'col-md-6'l><'col-md-6 d-flex justify-content-end'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 mt-2'p>>",
            
        initComplete: function(){

               $('.table').removeClass('invisible');
               $('#table').removeClass('invisible');
               $('input[type="search"]').unwrap();
               $('input[type="search"]').wrap(function() {
                                   return '<div id="customSearch" class="input-group input-group-sm"></div>';
                               });
               $('#customSearch').append('<div class="input-group-append"><span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span></div>');
             $('input[type="search"]').css('margin-left', '0');
             $('input[type="search"]').attr('placeholder', 'Rechercher');
         }  
    });
});