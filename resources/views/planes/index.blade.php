@extends('layouts.app')

@section('contenido')
            
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Plan de producción
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
                      <th>Orden de Trabajo</th>
                      <th>Modelo</th>
                      <th>Línea</th>
                      <th>Lote</th>
                      <th>Pzs X Hora</th>   
                      <th>Plan</th>          
                      <th>Estado</th>
                    </tr>
                  </thead>
                  <tbody>
                   @foreach($planes as $var)   
                    <tr>
                     <td>
                        <button data-toggle="modal" title="Editar" data-target="#myModalEdit{{$var['id']}}" type="button" class="btn btn-primary2 btn-circle btn-sm">
                        <img src="{{ asset('img/icono_editar_actualizar.png')}}" height="30">
                        </button> &nbsp;
                        @include('parts.edit')


                        @if($var['condicion']==1)
                          <button type="button"  title="Desactivar" class="btn btn-danger btn-circle btn-sm" data-toggle="modal" data-target="#myModalDesactivar{{$var['id']}}">
                            <img src="{{ asset('img/icono_cambiar_eliminar.png')}}" height="30">
                          </button>
                          @include('parts.delete')
                        @else
                            <button type="button"  title="Activar" class="btn btn-info btn-circle btn-sm" data-toggle="modal" data-target="#myModalActivar{{$var['id']}}">
                                <i class="fas fa-check"></i>
                            </button>
                            @include('parts.activar')
                        @endif
                     </td>
                     <td>{{$var['orden_trabajo']}}</td>
                     <td>{{$var['modelo']}}</td>
                     <td>{{$var['name_machine']}}</td>
                     <td>{{$var['lote']}}</td>
                     <td>{{$var['ict']}}</td>
                     <td>{{$var['plan']}}</td>
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
                        <h4 class="modal-title" style="color:rgb(0,51,100)">Nuevo Plan de Producción</h4>
                        <button type="button" class="close"  data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('pl_registrar')}}" role="form" method="post"  class="form-horizontal">
                           {{ csrf_field() }}
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Orden Trabajo</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="orden_trabajo" placeholder="Orden Trabajo" maxlength="30" required>
                                </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-md-3 form-control-label" for="text-input">Modelo</label>
                              <div class="col-md-9">
                                  <select class="form-control" name="model" required>
                                      <option value="" disabled selected>Seleccione</option>
                                      @foreach($models as $model)
                                      <option value="{{$model['id']}}">{{$model['name']}} </option>
                                      @endforeach
                                  </select>
                              </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Línea</label>
                            <div class="col-md-9">
                                <select class="form-control" name="idmachine" required>
                                    <option value="" disabled selected>Seleccione</option>
                                    @foreach($machines as $machine)
                                    <option value="{{$machine['id']}}">{{$machine['name']}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                            <div class="form-group row">
                              <label class="col-md-3 form-control-label" for="text-input">Lote</label>
                              <div class="col-md-9">
                                  <input type="text" class="form-control" name="lote" placeholder="Lote" maxlength="30" required>
                              </div>
                            </div>  

                            <div class="form-group row">
                              <label class="col-md-3 form-control-label" for="text-input">Pzs x Hora</label>
                              <div class="col-md-9">
                                  <input type="number" class="form-control" name="ict" placeholder="Pzs x Hora" maxlength="30" required>
                              </div>
                            </div>
                            
                            <div class="form-group row">
                              <label class="col-md-3 form-control-label" for="text-input">Plan</label>
                              <div class="col-md-9">
                                  <input type="number" class="form-control" name="plan" placeholder="Plan" maxlength="30" required>
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