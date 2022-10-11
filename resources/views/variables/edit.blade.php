 <!--Inicio del modal actualizar-->
 <div class="modal fade" id="myModalEdit{{$var['id']}}" aria-labelledby="myModal"  aria-hidden="true">
                                <div class="modal-dialog modal-primary modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" style="color:rgb(0,51,100)">Actualizar Variable</h4>
                                            <button type="button" class="close"  data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('v_edit')}}" role="form" method="post"  class="form-horizontal">
                                            {{ csrf_field() }} {{method_field('PUT')}}
                                                <div class="form-group row">
                                                    <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                                                    <div class="col-md-9">
                                                        <input type="hidden" class="form-control" name="id"  value="{{$var['id']}}" required> 
                                                        <input type="text" class="form-control" name="name" placeholder="Nombre de la maquina" value="{{$var['name']}}" maxlength="30" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 form-control-label" for="text-input">Descripción</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" name="description" placeholder="Descripción" value="{{$var['description']}}" maxlength="100" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 form-control-label" for="text-input">Maquina</label>
                                                    <div class="col-md-9">
                                                        <select class="form-control" name="idmachine" required>
                                                            <option value="">Seleccione</option>
                                                            @foreach($machines as $machine)
                                                            <option value="{{$machine['id']}}"  @if($machine['id']=== $var['idmachine']) selected='selected' @endif>{{$machine['name']}} </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 form-control-label" for="text-input">Eu</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" name="eu" maxlength="20" placeholder="Eu" value="{{$var['eu']}}" required>
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