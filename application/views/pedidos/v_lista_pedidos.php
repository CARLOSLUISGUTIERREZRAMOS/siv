<div class="box box-primary´">
    <div class="box-body">
        <?php
        $nuevo_pedido = $this->session->flashdata('nuevo_pedido');
        if (isset($nuevo_pedido)) {
            $nuevo_pedido = $this->session->flashdata('nuevo_pedido');;
            $nuevo_pedido = str_pad($nuevo_pedido, 11, "0", STR_PAD_LEFT);
            ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Exito!</h4>
                Se registro el pedido número <?= $nuevo_pedido ?>
            </div>
            <?php
        }
        ?>

        <div class="col-xs-12 table-responsive">
            <table class="table table-striped" id="tbl_list_pedidos">
                <thead>
                    <tr>
                        <th>Nro Pedido</th>
                        <th>Nombre del Cliente</th>
                        <th>Codigo Cliente</th>
                        <th>Presupuesto por compra</th>
                        <th>Saldo a Cobrar</th>
                        <th>Estado</th>
                        <th>Detalle</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pedidos->Result() as $pedido) { ?>

                        <tr>
                            <td><?= $pedido->codigo ?> </td>
                            <td><?= $pedido->nombres ?> </td>
                            <td><?= $pedido->cliente_codigo ?> </td>
                            <td><?= $pedido->presupuesto_x_compra ?> </td>
                            <td><?= ((float)$pedido->saldo > 0) ? $pedido->saldo : $pedido->precio_total ?> </td>
                            <td><?= ObtenerNombreEstado($pedido->estado) ?> </td>
                             <?php
                            if(isset($vincula_env_parciales) && $vincula_env_parciales){ ?>
                                <td><a type="button" class="btn btn-default" href="<?= base_url() ?>operaciones/EnviosParciales/EnvioParcialDetalle?codigo_pedido=<?= $pedido->codigo ?>&nombre_cliente=<?=$pedido->nombres?>"><i class="fa fa-th-list"></i></button></a>
                            <?php
                            }else{?>
                                <td><a type="button" class="btn btn-default" href="<?= base_url() ?>operaciones/<?=$controlador?>/VerDetallePedido?codigo_pedido=<?= $pedido->codigo ?>"><i class="fa fa-th-list"></i></button></a>
                            <?php
                            }
                            ?>
                        </tr>
                        <?php
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>
</div>