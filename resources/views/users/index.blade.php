@extends('layouts.app')

@section('contenido')
            
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Usuarios
              <button  data-toggle="modal" data-target="#myModalNuevo" class="btn btn-success btn-icon-split btn-sm">
                    <span class="text">Nuevo</span>
                    <span class="icon text-white-50">
                      <i class="fas fa-angle-down"></i>
                    </span>
              </button>
              </h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Opciones</th>
                      <th>Nombre</th>
                      <th>Email</th>
                      <th>Rol</th>
                      <th>Estado</th>
                      <th>Notificaciones</th>
                    </tr>
                  </thead>
                  <tbody>
                   @foreach($personas as $var)   
                    <tr>
                     <td>
                        <button data-toggle="modal" title="Editar"  data-target="#myModalEdit{{$var['id']}}" type="button" class="btn btn-primary2 btn-circle btn-sm">
                            <img src="{{ asset('img/icono_editar_actualizar.png')}}" height="25">
                        </button> &nbsp;
                        @include('users.edit')


                        @if($var['condicion']==1)
                          <button type="button" title="Desactivar" class="btn btn-circle btn-sm" data-toggle="modal" data-target="#myModalDesactivar{{$var['id']}}">
                              <img src="{{ asset('img/icono_cambiar_eliminar.png')}}" height="25">
                          </button>
                          @include('users.delete')
                        @else
                            <button type="button"  title="Activar" class="btn btn-info btn-circle btn-sm" data-toggle="modal" data-target="#myModalActivar{{$var['id']}}">
                                <i class="fas fa-check"></i>
                            </button>
                            @include('users.activar')
                        @endif
                     </td>
                     <td>{{$var['name']}}</td>
                     <td>{{$var['email']}}</td>
                     <td>{{$var['name_rol']}}</td>
                     <td>
                       @if($var['condicion']==1)
                         <div>
                            <span class="badge badge-success">Activo</span>
                         </div>
                         @else
                        <div>
                            <span class="badge badge-danger">Desactivado</span>
                        </div>
                        @endif
                    </td>
                    <td>
                       @if($var['notificaciones']==1)
                         <div>
                            <span class="badge badge-success">Activas</span>
                         </div>
                         @else
                        <div>
                            <span class="badge badge-danger">Desactivadas</span>
                        </div>
                        @endif
                    </td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
              <!--Inicio del modal agregar-->
        <div class="modal fade" id="myModalNuevo" aria-labelledby="myModal"  aria-hidden="true">
            <div class="modal-dialog modal-primary modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" style="color:rgb(0,51,100)">Nuevo Usuario</h4>
                        <button type="button" class="close"  data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('u_registrar')}}" role="form" method="post"  class="form-horizontal">
                           {{ csrf_field() }}
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="name" placeholder="Nombre del Usuario" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Email</label>
                                <div class="col-md-9">
                                    <input type="email" class="form-control" name="email" placeholder="Email del Usuario" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Password</label>
                                <div class="col-md-9">
                                    <input type="password" class="form-control" name="password" placeholder="Password del Usuario" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Rol</label>
                                <div class="col-md-9">
                                    <select class="form-control" name="idrol" required>
                                        <option value="" disabled selected>Seleccione</option>
                                        @foreach($roles as $rol)
                                        <option value="{{$rol['id']}}">{{$rol['description']}} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-md-3 form-control-label" for="text-input">Notificaciones </label>
                                <div class="col-md-9">
                                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="notif" name="notif">
                                    <label class="form-check-label" for="gridCheck1">
                                      Telegram
                                    </label>
                                  </div>
                                </div>
                            </div>
                            <div  class="form-group row div-error">
                                <div class="text-center text-error">
                                    <div>

                                    </div>
                                </div>
                            </div>

                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal">Cerrar</button>
                        <input type="submit" class="btn btn-success" value="Guardar">
                        </form>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!--Fin del modal-->
         
          
@endsection
@section('scripts')
<!-- Page level plugins -->
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<!-- Page level custom scripts -->
<script src="{{ asset('js/datatables.js') }}"></script>

@endsection