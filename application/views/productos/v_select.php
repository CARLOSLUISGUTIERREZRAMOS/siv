<select class="form-control select_productos" name="select_productos">
    <?php
    foreach ($allProductos->Result() as $item) { ?>
        <option data-precio="" value="<?=$item->codigo?>|<?=$item->costo_unitario?>"><?= $item->nombre?></option>
    <?php
    }
    ?>
</select>