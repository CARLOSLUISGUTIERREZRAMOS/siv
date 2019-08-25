<select class="form-control select_productos" name="producto_codigo">
<option value="" selected disabled hidden>Seleccione</option>
    <?php
    foreach ($allProductos->Result() as $item) { ?>
    <option data-precio="" value="<?= $item->codigo ?>|<?= $item->costo_unitario ?>"><?= $item->nombre ?></option>
    <?php
    }
    ?>
</select>