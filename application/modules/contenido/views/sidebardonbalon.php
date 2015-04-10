<link href="<?php echo base_url() ?>assets/css/styledonbalon.css" rel="stylesheet">
<link href="<?php echo base_url() ?>assets/css/sprites.css" rel="stylesheet">
<div id='FE_HP_1' style='margin-top: 5px; width: 300px; height: 250px;'>
    <!-- FE_HP_1 -->
    <script type='text/javascript'>GA_googleFillSlot("FE_HP_1");</script>
</div>


<!--Calendario-->
<div class="sidebar">
<div class="col-md-12 separador10  margen0 lateral">

<div id="collapseTwo" class="panel-collapse collapse in">
<div class="panel-body panel-body-clear-margin">
<!-- Nav tabs -->
<ul class="nav nav-tabs headernavtabs" role="tablist">
    <li class="active half  text-center backcuadros">
        <a href="#resultados" role="tab"
           data-toggle="tab"><h4 class="panel-title">Resultados</h4></a></li>
    <li class=" half  text-center backcuadros">
        <a href="#proximafecha" role="tab"
           data-toggle="tab"><h4 class="panel-title">Próxima Fecha</h4></a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    <div class="tab-pane active panel-no-border" id="resultados">
        <div class="well well-sm">
            <!--contenido colapsable-->
            <div class="panel-group" id="accordion2">
                <?php
                foreach ($campeonatosResultados as $campeonato) {
                    if (CHAMP_DEFAULT == $campeonato->champ) {
                        $active = "in";
                    } else {
                        $active = "";
                    }
                    ?>

                    <div class="panel panel-default panel-no-border">
                        <div class="panel-heading">
                            <h4 class="panel-title acordion-close font12">
                                <a data-toggle="collapse" data-parent="#accordion2"
                                   data-info="<?php echo $campeonato->champ; ?>"
                                   data-name="<?php echo $campeonato->shortname; ?>" class="panel-link"
                                   href="#<?php echo $campeonato->shortname; ?>">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php echo $campeonato->name; ?>
                                        </div>
                                    </div>
                                </a>
                            </h4>
                        </div>
                        <div id="<?php echo $campeonato->shortname; ?>"
                             class="panel-collapse collapse <?php echo $active; ?>">
                            <div class="panel-body panel-body-clear-margin">
                                <?php
                                foreach ($campeonato->partidos as $partido) {
                                    $resultado = explode("-", $partido->result);
                                    ?>
                                    <div class="panel panel-default">
                                        <a class="sidebarlink"
                                           href="<?= base_url('site/partido/' . $this->contenido->_urlFriendly($partido->hname) . '-' . $this->contenido->_urlFriendly($partido->aname) . '/' . $partido->id) ?>">

                                            <ul class="list-group">
                                                <li class="list-group-item">
                                                    <div class="col-md-10 col-xs-10 margen0">
                                                        <div class="col-md-12 col-xs-12 margen0   bordeabajo" >
                                                            <div class="col-md-1 col-xs-1 col-lg-1 text-center">
                                                                <?php if (count($resultado) >= 2) echo $resultado[0]; ?>
                                                            </div>
                                                            <div class="col-md-1 col-xs-1 col-lg-1 text-right ">
                                                                <img
                                                                    src="http://www.futbolecuador.com/<?php echo $partido->hshield; ?>"
                                                                    alt="<?php echo $partido->hname; ?>" title="<?php
                                                                if ( "Universidad Católica de Quito" == $partido->hname) $partido->hname = "U.C. de  Quito";
                                                                if ( "Independiente del Valle" == $partido->hname) $partido->hname = "I. del Valle";
                                                                echo $partido->hname; ?>">
                                                            </div>
                                                            <div class="col-md-10 col-xs-9 col-lg-8  ">
                                                                <?php echo $partido->hname; ?>
                                                            </div>

                                                        </div>
                                                        <div class="col-md-12 col-xs-12 col-lg-12 margen0   separador5">
                                                            <div class=" col-md-1  col-xs-1 col-lg-1 text-center">
                                                                <?php if (count($resultado) >= 2) echo $resultado[1]; ?>
                                                            </div>
                                                            <div class="col-md-1 col-xs-1 col-lg-1  text-right">
                                                                <img
                                                                    src="http://www.futbolecuador.com/<?php echo $partido->ashield; ?>"
                                                                    alt="<?php echo $partido->aname; ?>"
                                                                    title="<?php echo $partido->aname; ?>">
                                                            </div>
                                                            <div class="col-md-10 col-xs-9 col-lg-8  ">
                                                                <?php
                                                                if ( "Universidad Católica de Quito" == $partido->aname) $partido->aname = "U.C. de  Quito";
                                                                if ( "Independiente del Valle" == $partido->aname) $partido->aname = "I. del Valle";
                                                                echo $partido->aname; ?>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-xs-2 col-lg-2 margen0 text-center bordeizquierda">
                                                        <div style="font-size: 11px">
                                                            <?php echo ucwords(utf8_encode(strftime("%d %b", strtotime($partido->date_match)))); ?>
                                                            <?php echo ucwords(utf8_encode(strftime("%HH%M", strtotime($partido->date_match)))); ?>
                                                        </div>
                                                    </div>

                                                </li>

                                            </ul>
                                        </a>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                <?php
                }
                ?>
            </div>
        </div>
    </div>

    <div class="tab-pane  panel-no-border" id="proximafecha">
        <div class="well well-sm">
            <!--contenido colapsable-->
            <div class="panel-group" id="accordion1">
                <?php

                foreach ($campeonatos as $campeonato) {
                    $name_champ_default = "";
                    if (CHAMP_DEFAULT == $campeonato->champ) {
                        $name_champ_default = $campeonato->shortname;
                        $active = "in";
                    } else {
                        $active = "";
                    }
                    ?>

                    <div class="panel panel-default panel-no-border">
                        <div class="panel-heading">
                            <h4 class="panel-title acordion-close font12">
                                <a data-toggle="collapse" data-parent="#accordion1"
                                   data-info="<?php echo $campeonato->champ; ?>"
                                   data-name="<?php echo $campeonato->shortname; ?>" class=" panel-link"
                                   href="#<?php echo $campeonato->shortname; ?>1">
                                    <?php echo $campeonato->name; ?>
                                </a>
                            </h4>
                        </div>
                        <div id="<?php echo $campeonato->shortname; ?>1"
                             class="panel-collapse collapse <?php echo $active;
                             ?>">
                            <div class="panel-body panel-body-clear-margin">
                                <?php
                                foreach ($campeonato->partidos as $partido) {
                                    $resultado = explode("-", $partido->result);
                                    ?>
                                    <div class="panel panel-default">
                                        <a class="sidebarlink"
                                           href="<?= base_url('site/partido/' . $this->contenido->_urlFriendly($partido->hname) . '-' . $this->contenido->_urlFriendly($partido->aname) . '/' . $partido->id) ?>">
                                            <ul class="list-group">
                                                <li class="list-group-item">
                                                    <div class="col-md-10 col-xs-10 col-lg-10 margen0">
                                                        <div class="col-md-12 col-xs-12 col-lg-12 margen0   bordeabajo" >
                                                            <div class="col-md-1 col-xs-1 col-lg-1 text-center">

                                                            </div>
                                                            <div class="col-md-1 col-xs-1 col-lg-1 text-right ">
                                                                <img
                                                                    src="http://www.futbolecuador.com/<?php echo $partido->hshield; ?>"
                                                                    alt="<?php echo $partido->hname; ?>"
                                                                    title="<?php echo $partido->hname; ?>">
                                                            </div>
                                                            <div class="col-md-10  col-xs-9 col-lg-8">
                                                                <?php
                                                                if ( "Universidad Católica de Quito" == $partido->hname) $partido->hname = "U.C. de  Quito";
                                                                if ( "Independiente del Valle" == $partido->hname) $partido->hname = "I. del Valle";
                                                                echo $partido->hname; ?>
                                                            </div>

                                                        </div>
                                                        <div class="col-md-12 col-xs-12 col-lg-12 margen0   separador5">
                                                            <div class=" col-md-1 col-xs-1 col-lg-1 text-center">

                                                            </div>
                                                            <div class="col-md-1 col-xs-1 col-lg-1 text-right">
                                                                <img
                                                                    src="http://www.futbolecuador.com/<?php echo $partido->ashield; ?>"
                                                                    alt="<?php echo $partido->aname; ?>"
                                                                    title="<?php echo $partido->aname; ?>">
                                                            </div>
                                                            <div class="col-md-10 col-xs-9 col-lg-8">
                                                                <?php
                                                                if ( "Universidad Católica de Quito" == $partido->aname) $partido->aname = "U.C. de  Quito";
                                                                if ( "Independiente del Valle" == $partido->aname) $partido->aname = "I. del Valle";
                                                                echo $partido->aname; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-xs-2 col-lg-2 margen0 text-center bordeizquierda">
                                                        <div style="font-size: 11px">
                                                            <?php echo ucwords(utf8_encode(strftime("%d %b", strtotime($partido->date_match)))); ?>
                                                            <?php echo ucwords(utf8_encode(strftime("%HH%M", strtotime($partido->date_match)))); ?>
                                                        </div>
                                                    </div>

                                                </li>

                                            </ul>
                                        </a>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<div class="col-md-12 col-xs-12 text-right fondoazul separador10">
    <a class="result-link" href="<?= base_url('site/resultados/' . CHAMP_DEFAULT . '/' . $name_champ_default) ?>">Calendario
        Completo</a>
</div>
</div>
<!--Fin calendario -->
<!--Tabla de Posiciones-->
<? echo $tablaposiciones; ?>
<!--Goleadores-->
<div class="col-md-12 col-xs-12 separador10 margen0">
    <? echo $strikes; ?>
</div>
<!--Fin Goleadores -->
<!--La Voz de las Tribunas-->
<div class="col-md-12 col-xs-12 separador10 margen0">
    <? echo $laVozDeLasTribunas; ?>
</div>
</div>

