$(document).ready(function() {
    $('#table').DataTable({
        "order": [[ 1, "desc" ]],
        columnDefs: [
            { targets: [0], orderable: false}
        ],
        scrollX: true,
        language: {
            "decimal":        "",
            "emptyTable":     "No data available in table",
            "info":           "Showing _START_ to _END_ of _TOTAL_ entries",
            "infoEmpty":      "Showing 0 to 0 of 0 entries",
            "infoFiltered":   "(filtered from _MAX_ total entries)",
            "infoPostFix":    "",
            "thousands":      ",",
            "lengthMenu":     "Show _MENU_ entries",
            "loadingRecords": "Loading...",
            "processing":     "Processing...",
            "search":         "",
            "zeroRecords":    "No matching records found",
            "paginate": {
                "first":      "First",
                "last":       "Last",
                "next":       "Next",
                "previous":   "Previous"
            },
            "aria": {
                "sortAscending":  ": activate to sort column ascending",
                "sortDescending": ": activate to sort column descending"
            }
        },
        
        dom:"<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6 d-flex justify-content-end'f<'toolbar'>>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 mt-2'p>>",
        
        initComplete: function(){
            $("div.toolbar")
               .html(`<div class="ml-4">
                <a class="btn btn-success btn-sm" href="#" role="button"><i class="fas fa-plus"></i>  Ajouter</a>
                <a class="btn btn-warning btn-sm ml-1" href="#" role="button"><i class="fas fa-download"></i>  Télécharger</a>
               </div>`); 
         }  
    });

    
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

});