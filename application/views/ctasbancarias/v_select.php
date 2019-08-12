<select class="form-control select_cuentas" names="select_cuentas">
    <?php
    foreach ($ctasBancarias->Result() as $item) { ?>
        <option value="<?=$item->id?>"><?= $item->numero_cuenta?> - <?= $item->tipo_moneda?></option>
    <?php
    }
    ?>
</select>