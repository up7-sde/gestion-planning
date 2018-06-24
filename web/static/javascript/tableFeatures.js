$(document).ready(function() {
    $('#table').DataTable({
        columnDefs: [
            { targets: [-1], orderable: false}
        ],
        "scrollX": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
        }
    });
});