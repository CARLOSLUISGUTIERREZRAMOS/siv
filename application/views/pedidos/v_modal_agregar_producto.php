<form id="actualidarDatos" method="POST">
  <div class="modal fade" id="editaAgregaProductoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="">Agregar Producto</h4>
        </div>
        <div class="modal-body">
          <div id="datos_ajax"></div>
          <!-- <div class="form-group">
            <label for="recipient-name" class="control-label">Producto</label>
            
          </div> -->
          <div class="form-group">
            <label for="recipient-name" class="control-label">Seleccione Producto:</label>
            <?= armarSelectProductos() ?>
            
          </div>
          <input type="hidden" class="form-control" id="idabono" name="idabono">
          <input type="hidden" class="form-control" id="pedidoCodigo" name="pedidoCodigo">
          <input type="hidden" class="form-control" id="cuentaBancaria" name="cuentaBancaria">
          <input type="hidden" class="form-control" id="tipoCambio" name="tipoCambio">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </div>
      </div>
    </div>
  </div>
</form>