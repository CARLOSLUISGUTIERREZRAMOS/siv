<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Detalle</h3>
    </div>
    <div class="mailbox-read-info">
        <h3>Nro Pedido: <b><?= $codido_pedido ?></b></h3>
        <h5>Nombre del Cliente: <b><?= $nombre_cliente ?></b></h5>
        <h3>Estado: Envio Parcial</h3> 
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th style="width: 10px">Producto</th>
                    <th style="width: 20px">P.U.V.</th>
                    <th style="width: 20px">Requerim.</th>
                    <th style="width: 20px">Cant. Envio</th>
                    <th style="width: 20px">Cant. Pend. Envío</th>
                    <th style="width: 20px">Estado de Prod.</th>
                    <th style="width: 20px">Ppto. Para Compra</th>

                </tr>
                <?php
                $precio_total = 0;
                $precio_total_cant_envio = 0;
                $precio_total_cant_pend_envio = 0;
                $cant_pend_envio = 0;
                foreach ($items_parcial->Result() as $item) {

                    $precio_total += $item->PUV * $item->cant_solic;
                    $precio_total_cant_envio += $item->PUV * $item->cantidad_envio;
                    $cant_pend_envio = ((int) $item->cantidad_envio === 0) ? $item->cant_solic : $item->cant_pend_envio;
                    $precio_total_cant_pend_envio += $item->PUV * $cant_pend_envio;
                    ?>
                    <tr>
                        <td><?= $item->nombre ?></td>
                        <td><?= $item->PUV ?></td>
                        <td><?= $item->cant_solic ?></td>
                        <td><?= $item->cantidad_envio ?></td>
                        <td><?= $cant_pend_envio ?></td>
                        <td><?= ObtenerNombreEstado($item->estado) ?></td>
                        <td><?= $cant_pend_envio * $item->costo_unitario ?></td>

                    </tr>
                    <?php
                }
                ?>


            </tbody>
            <tfoot>
                <tr>
                    <td>Precio Total: </td>
                    <td colspan="2"><?= $precio_total ?></td>
                    <td><?= $precio_total_cant_envio ?></td>
                    <td><?= $precio_total_cant_pend_envio ?></td>

                </tr>
                <tr>
                    <td>Total Abonos: </td>
                    <td colspan="2"><?= $total_abonos ?></td>
                </tr>
                <tr>
                    <td>Saldo a Cobrar: </td>
                    <td></td>
                    <td></td>

                    <td><?= $saldo_a_cobrar = $precio_total_cant_envio - $total_abonos ?></td>
                    <td><?= $saldo_a_cobrar_pend_envio = ($precio_total - $precio_total_cant_envio) + $saldo_a_cobrar ?></td>
                </tr>
                <tr>
                    <td>Estado: </td>
                    <td></td>
                    <td></td>
                    <td><?= ($saldo_a_cobrar < 1) ? "Cancelado" : '' ?></td>
                    <td><?php
                    
                        if ($saldo_a_cobrar_pend_envio <= $precio_total && $saldo_a_cobrar_pend_envio > 0) {
                            $estado = "Pago Parcial";
                        } 
                        else if ((int)$precio_total_cant_pend_envio > 0) {
                            $estado = "Pendiente de pago";
                        }

                        echo $estado;
                        ?>

                    </td>
                </tr>
            </tfoot>
        </table>


    </div>
    <!-- /.box-body -->
</div>