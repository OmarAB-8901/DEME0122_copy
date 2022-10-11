<!--Inicio del modal actualizar-->
<div class="modal fade" id="myModalEdit" aria-labelledby="myModal"  aria-hidden="true">
    <div class="modal-dialog modal-primary modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" style="color:rgb(0,51,100)">Actualizar Justificación</h4>
                <button type="button" class="close"  data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('e_edit',['idmachine'=> $machine['id']])}}" role="form" method="post"  class="form-horizontal">
                {{ csrf_field() }} {{method_field('PUT')}}
                    <div class="form-group row">
                        <label class="col-md-3 form-control-label" for="text-input" style="color:rgb(0,51,100)">Justificación</label>
                        <div class="col-md-9">
                            <input type="hidden" class="form-control" name="id"  id="id"  required> 
                            <input type="hidden" class="form-control" name="idmachine"  id="idmachines"  required> 
                            <input type="text" class="form-control" name="justification" id="just" placeholder="Justificación del evento" maxlength="100" required>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">Cerrar</button>
                <input type="submit" class="btn btn-success" value="Actualizar">
                </form>
            </div>
        </div>    
    </div>
</div>
                         