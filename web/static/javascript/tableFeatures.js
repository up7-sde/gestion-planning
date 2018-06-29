$(document).ready(()=> {
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
            "info":           "_START_ à _END_ sur _TOTAL_",
            "infoEmpty":      "0 à 0 sur 0",
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
        
        dom:"<'row mt-2'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6 d-flex justify-content-end'f<'toolbar'>>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 mt-2'p>>",
        
        initComplete: function(){
            
            if (data[0]["enabled"]){
                $("div.toolbar")
                .html(`<div class="ml-2">
                 <a class="btn btn-success btn-sm" href="` + data[0]["action"] + `" role="button"><i class="fas fa-plus"></i> Ajouter</a>
                 <a class="btn btn-warning btn-sm" href="` + data[1]["action"] + `" role="button"><i class="fas fa-download"></i> Télécharger</a>
                </div>`);
            } else {
                $("div.toolbar")
                .html(`<div class="ml-2">
                 <a class="btn btn-success btn-sm disabled" href="#" role="button"><i class="fas fa-plus"></i> Ajouter</a>
                 <a class="btn btn-warning btn-sm disabled" href="#" role="button"><i class="fas fa-download"></i> Télécharger</a>
                </div>`);
            }

            
               $('.table').removeClass('invisible');
               $('#table').removeClass('invisible');
               $('input[type="search"]').unwrap();
               $('input[type="search"]').wrap(() => {
                                   return `<div id="customSearch" class="input-group input-group-sm"></div>`;
                               });
               $('#customSearch').append(`<div class="input-group-append">
               <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
             </div>`);
             $('input[type="search"]').css('margin-left', '0');
             $('input[type="search"]').attr('placeholder', 'Rechercher');
         }  
    });

    
   

});