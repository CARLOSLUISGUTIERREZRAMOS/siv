
<div class="modal fade" id="editaAbonoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id=""></h4>
      </div>
      <div class="modal-body">
        <form>
            
          <div class="form-group">
            <label for="recipient-name" class="control-label">Monto abonado:</label>
            <input type="text" class="form-control" id="montoAbonado">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="control-label">Cuentas Bancarias:</label>
            <?= armarSelectCtasBancarias()?>
          </div>
          
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary">Guardar cambios</button>
      </div>
    </div>
  </div>
</div>