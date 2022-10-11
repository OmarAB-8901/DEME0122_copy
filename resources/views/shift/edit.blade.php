 <!--Inicio del modal actualizar-->
 <div class="modal fade" id="myModalEdit{{$var['id']}}" aria-labelledby="myModal"  aria-hidden="true">
                                <div class="modal-dialog modal-primary modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" style="color:rgb(0,51,100)">Actualizar Turno</h4>
                                            <button type="button" class="close"  data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('s_edit')}}" role="form" method="post"  class="form-horizontal">
                                            {{ csrf_field() }} {{method_field('PUT')}}
                                                <div class="form-group row">
                                                    <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                                                    <div class="col-md-9">
                                                        <input type="hidden" class="form-control" name="id"  value="{{$var['id']}}" required> 
                                                        <input type="text" class="form-control" name="name" placeholder="Nombre del turno" value="{{$var['name']}}" maxlength="30" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 form-control-label" for="text-input">Hora de Inicio</label>
                                                    <div class="col-md-9">
                                                        <input type="time" class="form-control" name="start_time" placeholder="Hora de Inicio" value="{{$var['start_time']}}" maxlength="30" required>
                                                    </div>
                                                  </div> 
                      
                                                <div class="form-group row">
                                                    <label class="col-md-3 form-control-label" for="text-input">Hora de Salida</label>
                                                    <div class="col-md-9">
                                                        <input type="time" class="form-control" name="end_time" placeholder="Hora de Salida" value="{{$var['end_time']}}" maxlength="30" required>
                                                    </div>
                                                </div> 
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-success" data-dismiss="modal">Cerrar</button>
                                            <input type="submit" class="btn btn-success" value="Actualizar">
                                            </form>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!--Fin del modal-->