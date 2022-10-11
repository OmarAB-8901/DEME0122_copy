<!--Inicio del modal Disponibilidad-->
<div class="modal fade" id="myModalDis" aria-labelledby="myModal"  aria-hidden="true">
    <div class="modal-dialog modal-primary modal-lg" role="document" style="max-width: 18%">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" >Disponibilidad</h5>  
                <button type="button" class="close"  data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <h6>Availability = runningTime / AvailableTime</h6>
                <div align="center">
                    <math>
                        <mfrac>
                            <mi id="RunningTime"></mi>
                            <mi id="AvailableTime"></mi>
                        </mfrac>
                        <mo>=</mo>
                        <mi id="resAvailability"></mi>
                    </math>
                </div>
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div> -->
        </div>    
    </div>
</div>
<!--Inicio del modal Rendimiento-->
<div class="modal fade" id="myModalRen" aria-labelledby="myModal"  aria-hidden="true">
    <div class="modal-dialog modal-primary modal-lg" role="document" style="max-width: 20%">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" >Rendimiento</h5>
                <button type="button" class="close"  data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
            <h6>Throghput = (TotalParts * ICT)/RunningTime</h6>
                <div align="center">
                        <math>
                            <mfrac>
                                <mrow>
                                    <mi id="TotalParts"></mi>
                                    <mo>*</mo>
                                    <mi id="IdealCycleTime"></mi>
                                </mrow>
                                <mi id="RunningTime2"></mi>
                            </mfrac>
                            <mo>=</mo>
                            <mi id="resThroghput"></mi>
                        </math>
                </div>
            </div>
           
        </div>    
    </div>
</div>
<!--Inicio del modal Calidad-->
<div class="modal fade" id="myModalCal" aria-labelledby="myModal"  aria-hidden="true">
    <div class="modal-dialog modal-primary modal-lg" role="document" style="max-width: 18%">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" >Calidad</h5>
                <button type="button" class="close"  data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <h6>Quality = GoodParts / TotalParts</h6>
                <div align="center">
                    <math>
                        <mfrac>
                            <mi id="GoodParts"></mi>
                            <mi id="TotalParts2"></mi>
                        </mfrac>
                        <mo>=</mo>
                        <mi id="resQuality"></mi>
                    </math>
                </div>
            </div>
           
        </div>    
    </div>
</div>
                         