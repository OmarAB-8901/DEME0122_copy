@extends('andon_scorecard.contenido')

@section('andonscore')
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3" style="background-color:rgb(250,250,250);border-color:rgb(250,250,250)">
                    
                @foreach($machines as $machine)
                    <h1 class="m-0 font-weight-bold text-primary" style="text-align:center">SCORECARD {{$machine['name']}}</h1>     
                    <input type="hidden" class="form-control" name="var_name" id="var_name" value="{{$machine['name']}}">
                    <input type="hidden" class="form-control" name="idmachine" id="idmachine" value="{{$machine['id']}}">
                    <input type="hidden" class="form-control" name="date" id="date" value="{{$date}}">
                @endforeach
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" style="color: rgb(0,51,100);">
                        <thead>
                        <tr>
                            <th scope="col" class="table-primary">HORA</th>
                            <th scope="col" class="table-success">META</th>
                            <th scope="col" class="table-warning">PROD</th>
                            <th scope="col" class="table-info">ACUM</th>
                            <th scope="col" class="table-danger">BALANCE</th>
                            <th scope="col" class="table-warning">COMENTARIOS</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row" class="table-primary" style="font-size: 25px">7-8</th>
                            <td style="font-size: 25px">175</td>
                            <td style="font-size: 25px">72</td>
                            <td style="font-size: 25px">72</td>
                            <td style="font-size: 25px">-103</td>
                            <td style="font-size: 25px"></td>
                        </tr>
                        <tr>
                            <th scope="row" class="table-primary" style="font-size: 25px">8-9</th>
                            <td style="font-size: 25px">87</td>
                            <td style="font-size: 25px">73</td>
                            <td style="font-size: 25px">145</td>
                            <td style="font-size: 25px">-117</td>
                            <td style="font-size: 25px"></td>
                        </tr>
                        <tr>
                            <th scope="row" class="table-primary" style="font-size: 25px">9-10</th>
                            <td style="font-size: 25px">175</td>
                            <td style="font-size: 25px">148</td>
                            <td style="font-size: 25px">293</td>
                            <td style="font-size: 25px">-144</td>
                            <td style="font-size: 25px"></td>
                        </tr>
                        <tr>
                            <th scope="row" class="table-primary" style="font-size: 25px">10-11</th>
                            <td style="font-size: 25px">175</td>
                            <td style="font-size: 25px">148</td>
                            <td style="font-size: 25px">441</td>
                            <td style="font-size: 25px">-171</td>
                            <td style="font-size: 25px"></td>
                        </tr>
                        <tr>
                            <th scope="row" class="table-primary" style="font-size: 25px">11-12</th>
                            <td style="font-size: 25px">175</td>
                            <td style="font-size: 25px">148</td>
                            <td style="font-size: 25px">589</td>
                            <td style="font-size: 25px">-198</td>
                            <td style="font-size: 25px"></td>
                        </tr>
                        <tr>
                            <th scope="row" class="table-primary" style="font-size: 25px">12-1</th>
                            <td style="font-size: 25px">175</td>
                            <td style="font-size: 25px">112</td>
                            <td style="font-size: 25px">701</td>
                            <td style="font-size: 25px">-261</td>
                            <td style="font-size: 25px"></td>
                        </tr>
                        <tr>
                            <th scope="row" class="table-primary" style="font-size: 25px">1-2</th>
                            <td style="font-size: 25px">88</td>
                            <td style="font-size: 25px">74</td>
                            <td style="font-size: 25px">775</td>
                            <td style="font-size: 25px">-275</td>
                            <td style="font-size: 25px"></td>
                        </tr>
                        <tr>
                            <th scope="row" class="table-primary" style="font-size: 25px">2-3</th>
                            <td style="font-size: 25px">175</td>
                            <td style="font-size: 25px">190</td>
                            <td style="font-size: 25px">965</td>
                            <td style="font-size: 25px">-260</td>
                            <td style="font-size: 25px"></td>
                        </tr>
                        <tr>
                            <th scope="row" class="table-primary" style="font-size: 25px">3-4</th>
                            <td style="font-size: 25px">175</td>
                            <td style="font-size: 25px"></td>
                            <td style="font-size: 25px"></td>
                            <td style="font-size: 25px"></td>
                            <td style="font-size: 25px"></td>
                        </tr>
                        <tr>
                            <th scope="row" class="table-primary" style="font-size: 25px">4-5</th>
                            <td style="font-size: 25px">175</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th scope="row" class="table-primary" style="font-size: 25px">5-6</th>
                            <td style="font-size: 25px">175</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th scope="row" class="table-primary" style="font-size: 25px">6-7</th>
                            <td style="font-size: 25px">175</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
{{-- <script src="{{ asset('js/andon.js')}}"></script>
<script src="{{ asset('js/andon5.js')}}"></script> --}}
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/datatables.js') }}"></script>
<!-- Page level custom scripts -->
@endsection