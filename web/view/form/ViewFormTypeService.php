<!-- Service -->
<div class="form-group">
  <label class="col-md-4 control-label" for="radios">Type de service</label>
  <div class="col-md-4">
    <?php foreach ($labelTypeService as $e) { ?>
      <div class="radio">
        <label for="radios-0">
            <input name="idTypeService" value="<?= $e["id"] ?>"

            <?php
              // S'il y a des données (dans le cas d'une modification) 
              if (isset($data))
              {
                // Selectionner le bon element dans la liste
                if ($e["id"] == $data["TypeService_idTypeService"])
                {
                  echo 'checked="checked"';
                }
              }
             ?>

            type="radio"></option>
          <?= $e["nom"] ?>
        </label>
    	</div>
    <?php } ?>
  </div>
</div>
