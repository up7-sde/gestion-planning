<!-- Annee -->
<div class="form-group">
  <label class="col-md-4 control-label" for="anneeInput">Annee</label>
  <div class="col-md-4">
  <input value="
  <?php
  // S'il y a des données (dans le cas d'une modification) 
  if (isset($data))
  {
    echo $data["annee"];
  }
  ?>
  " name="annee" class="form-control input-md" required="" type="text">
  </div>
</div>
