@inject('groups','App\Http\Controllers\GroupController')
@inject('variables','App\Http\Controllers\VariableController')
 <!-- Nav Item - Dashboard -->
   
    <!-- Heading -->
    <div class="sidebar-heading">
        Menu
    </div>

    @foreach($groups->listMachinesGroup() as $machine)
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">    
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse{{$machine['id']}}" aria-expanded="true" aria-controls="collapseTwo">
            <center>
               <img src="{{ asset('img/configuraciones.png')}}" height="70">
               <br>
                <span>{{$machine['name_machine']}}</span>
            </center>
        </a>
        <div id="collapse{{$machine['id']}}" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            @if($machine['activar_oee']==1)
            <a class="collapse-item" href="{{route('oee',['idmachine'=> $machine['id']])}}">Oee</a>
            @endif
            @if($machine['activar_eventos']==1)
            <a class="collapse-item"  href="{{route('events',['idmachine'=> $machine['id']])}}">Tiempos Muertos</a>
            @endif
            @foreach($variables->listVaribles($machine['id']) as $var)
            <a class="collapse-item"  href="{{route('trends',['idvariable'=> $var['id']])}}">{{$var['name']}}</a>
            @endforeach
            {{-- @if($machine['activar_oee']==1)
            <a class="collapse-item" href="{{route('andon',['idmachine'=> $machine['id']])}}">Andon</a>
            @endif --}}
        </div>
        </div> 
    </li>
    @endforeach 

    