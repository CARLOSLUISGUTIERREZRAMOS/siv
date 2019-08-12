<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-check"></i> <?= $title ?></h4>
    <?php
    if (!is_null($msg)) { ?>
    <p><?= $msg ?></p>
    <?php
    }
    ?>

</div>