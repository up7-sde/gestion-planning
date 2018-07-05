(() => {
    'use strict';
    window.addEventListener('load', function() {
      
      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.getElementsByClassName('needs-validation');
      // Loop over them and prevent submission
      var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
          
          if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
            form.classList.add('was-validated');
            
          } else {
            if ($('.needs-validation').hasClass('with-alert')){
              if(!confirm('Vous êtes sur le point de modifier une ressource, êtes vous sûr de vouloir continuer?')){
                event.preventDefault();
                event.stopPropagation();
              }
            }
          }

        }, false);
      });
    }, false);
  })();

var password = document.querySelector("#mdp")
, confirm_password = document.querySelector("#mdp2");

if (password!==null){
  function validatePassword(){
    
    if(password.value != confirm_password.value) {
      confirm_password.setCustomValidity("No match");
    } else {
      confirm_password.setCustomValidity('');
    }
  }
  password.onchange = validatePassword;
  confirm_password.onkeyup = validatePassword;
}