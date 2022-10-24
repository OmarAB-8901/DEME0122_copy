@extends('layouts.app')

@section('contenido')
            
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Catálogo de Modelos
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
                <label for="">Sensor conteo de piezas:</label>  
                @foreach($hab_sensor as $var)   
                  @if($var['conteo_pzs']==1)
                    <form action="{{route('mods_desactivar')}}" role="form" method="post"  class="form-horizontal">
                      {{ csrf_field() }} {{method_field('PUT')}}
                      <input type="hidden" class="form-control" name="id"  value="{{$var['id']}}" required> 
                      &nbsp; <button type="submit"  title="Desactivar" class="btn btn-danger btn-circle btn-sm">
                        <img src="{{ asset('img/icono_remove.png')}}" height="30">
                      </button>
                    </form>
                    @else
                    <form action="{{route('mods_activar')}}" role="form" method="post"  class="form-horizontal">
                      {{ csrf_field() }} {{method_field('PUT')}}
                      <input type="hidden" class="form-control" name="id"  value="{{$var['id']}}" required>  
                      &nbsp;<button type="submit"  title="Activar" class="btn btn-info btn-circle btn-sm">
                          <i class="fas fa-check"></i>
                      </button>
                    </form>      
                  @endif
                @endforeach
              </div>
              <hr class="sidebar-divider">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Opciones</th>
                      <th>Modelo</th>
                      <th>Descripción</th>
                      <th>Valor Std.</th>          
                      <th>Estado</th>
                    </tr>
                  </thead>
                  <tbody>
                   @foreach($models as $var)   
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
                     <td>{{$var['name']}}</td>
                     <td>{{$var['description']}}</td>
                     <td>{{$var['valor_std']}}</td>
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
                        <h4 class="modal-title" style="color:rgb(0,51,100)">Nuevo Modelo</h4>
                        <button type="button" class="close"  data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('mod_registrar')}}" role="form" method="post"  class="form-horizontal">
                           {{ csrf_field() }}
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Modelo</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="name" placeholder="Nombre de Modelo" maxlength="30" required>
                                </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-md-3 form-control-label" for="text-input">Descripción</label>
                              <div class="col-md-9">
                                  <input type="text" class="form-control" name="description" placeholder="Descripción" maxlength="30" required>
                              </div>
                            </div>  

                            <div class="form-group row">
                              <label class="col-md-3 form-control-label" for="text-input">Valor Std</label>
                              <div class="col-md-9">
                                  <input type="number" class="form-control" name="valor_std" placeholder="Valor Std" maxlength="30" required>
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