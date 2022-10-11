@extends('layouts.app')

@section('contenido')

<div class="row">
    <div class="col-xl-9 col-lg-7">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                @foreach($variables as $var)
                    <h6 class="m-0 font-weight-bold text-primary">{{$var['name_machine']}}</h6>
                    <input type="hidden" class="form-control" name="var_name" id="var_name" value="{{$var['name']}}"> 
                    <input type="hidden" class="form-control" name="idvariable" id="idvariable" value="{{$var['id']}}"> 
                    <input type="hidden" class="form-control" name="eu" id="eu" value="{{$var['eu']}}">
                    <input type="hidden" class="form-control" name="date" id="date" value="{{$date}}">
                    <input type="hidden" class="form-control" name="description" id="description" value="{{$var['description']}}">       
                @endforeach
            </div>
            
            <div class="card-body">
                <div class="row">
                    <div class="echarts" id="chart-panel" style="width: 900px; height: 390px;"></div>
                </div>
            </div>
            <!--Inicio del modal Loading-->
            <div class="modal fade" id="myModalLoading" aria-labelledby="myModalLoading" aria-hidden="true" style="lefto:auto">
                <div class="modal-dialog modal-primary modal-lg modal-dialog-centered " role="document">
                    <div class="modal-content" style="background:transparent; border:none; align-self: center;">
                        <div class="spinner-border text-dangerr" style="width:250px; height: 250px; align-self: center; color:rgb(128,34,36);" role="status"></div>
                        <br>
                        <h5 style="align-self: center; color:rgb(128,34,36);">Loading...</h5>
                    </div>
                </div>
            </div>
            <!--Fin Modal Loading -->
                
        </div>
    </div>
    @include('controles.fecha')
</div>

@endsection
@section('scripts')
<script src="{{ asset('vendor/echarts/echarts.min.js')}}"></script>

             
<!--Probar los ejemplos de minutos al dia y de promedios por hora al mes para observar la estructura que toma el canvas!-->
<script src="{{ asset('js/minutes.js')}}"></script>
<script>
 $(document).ready(function()
    {
        $('#myModalLoading').modal({ backdrop: 'static', keyboard: false });  
        window.addEventListener('resize',function(){
            myChart.resize();
        });

    });

</script>
<script>
    $(function () {
        $('#i_dia').datepicker({
            format: "yyyy-mm-dd"
            }).datepicker("setDate", new Date());
    });
    $(document).ready(function()
        {  
            $("#i_dia").click(function() {
                $('.datepicker').css("display", "block");
            });
            $("#i_dia").change(function () {
                var date = $('#i_dia').val();
                $('.datepicker').css("display", "none");
                $('#myModalLoading').modal({ backdrop: 'static', keyboard: false }); 
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')     
                    }
                }); 
                $.ajax({
                        url:'/trends/'+idvariable+'/d/'+date+'/datos',
                        type:'GET',
                        success:function(response){
                            option.xAxis.data.length = 0;
                            option.series[0].data.length = 0; 
                            option.series[1].data.length = 0;
                            option.series[2].data.length = 0;
                        response.forEach(function (elemento, indice) {
                            
                            option.xAxis.data.push(elemento['date'])
                            option.series[0].data.push(elemento['value']);
                            option.series[1].data.push(elemento['highLimit']);
                            option.series[2].data.push(elemento['lowLimit']);

                        });
                        setTimeout(() => {
                            $('#myModalLoading').modal('hide');
                        }, 3);          
                        myChart.setOption(option);
                        
                        }
                });

            });
        
    });


</script>
<script src="{{ asset('js/monitoreo.js')}}"></script>

@endsection
