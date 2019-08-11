<select class="form-control select_cuentas">
    <?php
    foreach ($ctasBancarias->Result() as $item) { ?>
        <option id="<?=$item->id?>" value="PEN"><?= $item->numero_cuenta?> - <?= $item->tipo_moneda?></option>
        
    <?php
    }
    ?>
</select>