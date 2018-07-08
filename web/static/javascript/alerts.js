var deleteButtons = document.querySelectorAll('#deleteButton');

for (var i = 0, len = deleteButtons.length; i < len; i++) {
    deleteButtons[i].addEventListener('click', function(e) {
        confirm('Vous êtes sur le point de supprimer une ressource, êtes vous sûr de vouloir continuer?') ? true : e.preventDefault();
    });
}