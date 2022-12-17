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
                      <th>Es Defecto</th>
                    </tr>
                  </thead>
                  <tbody>
                   @foreach($calidad as $var)   
                    <tr>
                     <td>{{$var['fecha']->format('d-m-Y')}}</td>
                     <td>{{$var['hora']->isoFormat('H:mm:ss A');}}</td>
                     <td>{{$var['descrip']}}</td>
                     <td>{{$var['name']}}</td>
                     <td>{{$var['description']}}</td>
                     <td>{{$var['cantidad']}}</td>
                     <td>{{$var['isdefect']}}</td>
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