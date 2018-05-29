<!-- Enseignement -->
<div class="form-group">
  <label class="col-md-4 control-label" for="selectbasic">Enseignement</label>
  <div class="col-md-4">
    <select id="apogee" name="apogee" class="form-control">
      <?php
        foreach ($labelEnseignement as $e) { ?>
        <option name="apogee" value="<?= $e["id"] ?>"
          <?php
          // Selectionner le bon élément
          if ($e["id"] == $data["Enseignement_apogee"])
          {
            echo ' selected';
          }
        ?>>
          <?= $e["nom"]?>
        </option>
      <?php } ?>
    </select>
  </div>
</div>
