<!-- Enseignant -->
<div class="form-group">
  <label class="col-md-4 control-label" for="selectbasic">Enseignant</label>
  <div class="col-md-4">
    <select name="idEnseignant" class="form-control">
      <?php foreach ($labelEnseignant as $e) { ?>
        <option value="<?= $e["id"] ?>"
          <?php
          // Selectionner le bon élément
          if ($e["id"] == $data["Enseignant_idEnseignant"])
          {
            echo ' selected';
          }
        ?>>
        <?= $e["nom"]?></option>
      <?php } ?>
    </select>
  </div>
</div>
