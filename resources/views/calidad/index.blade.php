@extends('layouts.app')

@section('contenido')
            
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Reporte de Defectos</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      {{-- <th>Opciones</th> --}}
                      <th>Fecha</th>
                      <th>Hora</th>
                      <th>Grupo Scrap</th>
                      <th>Nombre</th>
                      <th>Descripción</th>
                      <th>Cantidad</th>
                      <th>Es Scrap</th>
                      <th>Cambiar status</th>
                    </tr>
                  </thead>
                  <tbody>
                   @foreach($calidad as $var)   
                    <tr>
                     <td>{{date('Y-m-d', strtotime( $var['fecha'] ))}}</td>
                     <!-- <td>{{date('d-m-Y', strtotime( $var['fecha'] ))}}</td> -->
                     <td>{{date('H:i:s', strtotime( $var['fecha'] ))}}</td>
                     <td>{{$var['descrip']}}</td>
                     <td>{{$var['name']}}</td>
                     <td>{{$var['description']}}</td>
                     <td>{{$var['cantidad']}}</td>
                     <td>
                      @if($var['isdefect']==1)
                        <div>
                           <span class="badge badge-success">Sí</span>
                        </div>
                        @else
                       <div>
                           <span class="badge badge-danger">No</span>
                       </div>
                       @endif
                     </td>
                     <td>
                      @if($var['isdefect']==0)
                      <button type="button"  title="Defecto" class="btn btn-circle btn-sm" data-toggle="modal" data-target="#myModalDesactivar{{$var['id']}}">
                        <img src="{{ asset('img/icono_isdefecto.png')}}" height="35">
                      </button>
                      @include('calidad.delete')
                    @else
                        <button type="button"  title="No defecto" class="btn btn-info btn-circle btn-sm" data-toggle="modal" data-target="#myModalActivar{{$var['id']}}">
                          <i class="fas fa-check"></i>
                        </button>
                        @include('calidad.activar')
                    @endif
                     </td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
       
          
@endsection
@section('scripts')
<!-- Page level plugins -->
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<!-- Page level custom scripts -->
<script src="{{ asset('js/datatables.js') }}"></script>

@endsection