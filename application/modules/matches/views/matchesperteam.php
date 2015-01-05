<?php
$estado['0'] = 'No Iniciado';
$estado['1'] = 'Primer Tiempo';
$estado['2'] = 'Fin del Primer Tiempo';
$estado['3'] = 'Segundo Tiempo';
$estado['4'] = 'Fin Segundo Tiempo';
$estado['5'] = 'Primer Extra';
$estado['6'] = 'Segundo Extra';
$estado['7'] = 'Penales';
$estado['8'] = 'Fin del Partido';?>
<!--Tabla de posiciones-->


<div class="col-md-12   margen0">
    <div class="panel-group  " id="accordion" role="tablist" aria-multiselectable="true">
        <?php
        $i = 1;
        foreach ($teamsFecha as $key => $teams) {
            foreach ($teams as $key => $team) {
                //filtro los partidos del equipo solamente
                if (($team->hid == $idEquipo) or ($team->aid == $idEquipo)) {
                    if ($teams_pics['shield'][$team->hid] == "") $teams_pics['shield'][$team->hid] = "imagenes/teams/shield/default.png";
                    ?>
                    <div class="col-md-12 separador10 margen0  cabeceraequipo  fa-border ">
                        <a class="sidebarlink"
                           href="<?= base_url('site/partido/' . $this->matches->_urlFriendly($team->hname) . '-' . $this->matches->_urlFriendly($team->aname) . '/' . $team->id) ?>">

                            <div class="col-md-2 margen0 text-center ">
                                <img
                                    src="<?= base_url($teams_pics['shield'][$team->hid]); ?>">
                            </div>
                            <div class="col-md-8 separador10 margen0    ">
                                <div class="col-md-5 text-left nombre-equipo margen0 ">
                                    <?= $team->hname ?>
                                </div>
                                <div class="col-md-2 text-center margen0">
                                    <div class="col-md-12 text-center resultado-equipo margen0">
                                        <? echo ($team->result == "") ? "vs" : $team->result; ?>
                                    </div>
                                    <div class="col-md-12 text-center margen0 textos-equipo">
                                        <?= $estado[$team->state] ?>
                                    </div>
                                </div>
                                <div class="col-md-5 text-right nombre-equipo margen0">
                                    <?= $team->aname ?>
                                </div>
                                <div class="col-md-12 text-center textos-equipo">
                                    <?= $team->dm ?>
                                </div>
                            </div>
                            <div class="col-md-2 text-center margen0">
                                <img
                                    src="<?= base_url($teams_pics['shield'][$team->aid]); ?>">
                            </div>
                        </a>


                    </div>
                <?php
                }
            }
        }
        ?>

    </div>
</div>
