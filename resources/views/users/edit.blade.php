 <!--Inicio del modal actualizar-->
 <div class="modal fade" id="myModalEdit{{$var['id']}}" aria-labelledby="myModal"  aria-hidden="true">
                                <div class="modal-dialog modal-primary modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" style="color:rgb(0,51,100)">Actualizar Usuario</h4>
                                            <button type="button" class="close"  data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('u_edit')}}" role="form" method="post"  class="form-horizontal">
                                            {{ csrf_field() }} {{method_field('PUT')}}
                                                <div class="form-group row">
                                                    <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                                                    <div class="col-md-9">
                                                        <input type="hidden" class="form-control" name="id"  value="{{$var['id']}}" required> 
                                                        <input type="text" class="form-control" name="name" placeholder="Nombre de la maquina" value="{{$var['name']}}" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 form-control-label" for="text-input">Email</label>
                                                    <div class="col-md-9">
                                                        <input type="email" class="form-control" name="email" placeholder="Email del Usuario" value="{{$var['email']}}" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 form-control-label" for="text-input">Password</label>
                                                    <div class="col-md-9">
                                                        <input type="password" class="form-control" name="password" placeholder="Password del Usuario" value="{{$var['password']}}" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 form-control-label" for="text-input">Rol</label>
                                                    <div class="col-md-9">
                                                        <select class="form-control" name="idrol" required>
                                                            <option value="">Seleccione</option>
                                                            @foreach($roles as $rol)
                                                            <option value="{{$rol['id']}}"  @if($rol['id']=== $var['role_id']) selected='selected' @endif>{{$rol['description']}} </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                <label class="col-md-3 form-control-label" for="text-input">Notificaciones</label>
                                                    <div class="col-md-9">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="notif" name="notif" @if($var['notificaciones']=== 1) checked @endif>
                                                        <label class="form-check-label" for="gridCheck1">
                                                        Telegram
                                                        </label>
                                                    </div>
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