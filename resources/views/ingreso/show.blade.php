<div class="modal fade" id="#modal-show" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Detalle Ingreso</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Fecha:</label>
          <input class="form-control" name="fecha" id="fecha" type="date">
        </div>
        <div class="form-group">
          <label for="">Detalle:</label>
          <!-- <textarea class="form-control" rows="3" name="detalle" id="detalle"></textarea> -->
          <input class="form-control" placeholder="Detalle" name="detalle" id="detalle">
        </textarea>
      </div>
      <div class="form-group">
        <label>Estado:</label>
        <select name="estado" class="form-control selectpicker" data-live-search="true">
          <option></option>
        </select>
      </div>
      <div class="form-group">
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
          <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
            <thead>

              <th>Medio</th>
              <th>Cantidad</th>
            </thead>
            <tbody>
              <tr>
                
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="modal-footer ">

        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cerrar</button>
      </div>
    </div>
    <!-- /.modal-content --> 
  </div>
  <!-- /.modal-dialog --> 
</div>