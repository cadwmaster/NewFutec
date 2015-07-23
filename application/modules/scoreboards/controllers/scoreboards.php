<?php

class Scoreboards extends MY_Controller
{

    public $model = 'mdl_scoreboards';

    public function __construct()
    {
        parent::__construct();
    }

    public function tablaposiciones($temporada, $tipoChamp = 'acumulada')
    {
        $data['tipoCampeonato'] = $tipoChamp;
        if ($tipoChamp == 'acumulada') {
            $data['scroreBoardAcumulative'] = $this->leaderboard_cumulative($temporada);
            $data['scroreBoardSingle'] = $this->leaderboard($temporada);
            $data['champ'] = $temporada;
            $data['tipoCampeonato'] = $tipoChamp;
            $conten = strip_tags(trim($data['scroreBoardSingle']));
            if ($conten == "Tabla vacía") {
                $data['scroreBoardSingle'] = $data['scroreBoardAcumulative'];
            }
            return $this->load->view('tablaposiciones', $data, TRUE);
        } else {
            $data['scroreBoardSingle'] = $this->leaderboard($temporada, 'leaderboard', $tipoChamp);
            $data['champ'] = $temporada;
            $data['tipoCampeonato'] = $tipoChamp;
            return $this->load->view('tablaposicionessimple', $data, TRUE);
        }
    }

    public function sancionBarcelona ($tabla ) {
        foreach ($tabla as $key=>$equipo )
        {
            if ($equipo['name']== "Barcelona"){
                $tabla[$key]['points'] = $equipo['points']- 1;
            }
        }
        return $tabla;
    }

    public function sancionLDUL ($tabla ) {
        foreach ($tabla as $key=>$equipo )
        {
            if ($equipo['name']== "Liga de Loja"){
                $tabla[$key]['points'] = $equipo['points'] - 3;
            }
        }
        return $tabla;
    }

    // Tabla de Posiciones
    public function leaderboard($champ, $leaderboard = 'leaderboard', $tipoCampeonato = 'acumulada')
    {
        $data['tipoCampeonato'] = $tipoCampeonato;
        $round = $this->mdl_teams_position->get_active_round($champ);
        if ($tipoCampeonato == 'acumulada') {
            $data['change'] = array(base_url() . 'imagenes/icons/flecha_arriba.png',
                base_url() . 'imagenes/icons/igual.png',
                base_url() . 'imagenes/icons/flecha_abajo.png');

            if ($round != false) {
                $active_group = current($this->mdl_teams_position->get_by_round($round));
                $data['teams'] = $this->mdl_teams_position->get_teams($champ);
                $data['tabla'] = $this->mdl_teams_position->get_table($active_group->id);

                //barcelona sancion campeonato 2015.
                if ($round == 196) {
                    $data['tabla'] = $this->sancionLDUL ($data['tabla']);
                    $data['tabla'] = $this->sancionBarcelona ($data['tabla']);
                }



                return $this->load->view($leaderboard, $data, true);
            } else {
                return false;
            }
        } else {
            // para el caso que son simples, el icono no se usa el sprite sino la imagen del equipo
            $data['change'] = array(base_url() . 'imagenes/icons/flecha_arriba.png',
                base_url() . 'imagenes/icons/igual.png',
                base_url() . 'imagenes/icons/flecha_abajo.png');

            if ($round != false) {

                //caso compa america
                if ($champ == 56 ) $round = 205;

                $grupoActivo = $this->mdl_teams_position->get_by_round($round);
                $data['tabla'] = array();
                $tablas="";
                $data['teams'] = $this->mdl_teams_position->get_teams($champ);
                //recuperamos los resultados de cada grupo
                foreach ($grupoActivo as $grupo) {
                    //$data['tabla'] = array_merge($data['tabla'], $this->mdl_teams_position->get_table($grupo->id));
                    $data['tabla'] =  $this->mdl_teams_position->get_table($grupo->id);
                    //barcelona sancion campeonato 2015.
                    if ($round == 196) {
                        $data['tabla'] = $this->sancionLDUL ($data['tabla']);
                        $data['tabla'] = $this->sancionBarcelona ($data['tabla']);
                    }

                    return $this->load->view($leaderboard, $data, true);

                    $tablas = $tablas . $this->load->view($leaderboard, $data, true);
                }
                return $tablas;
            } else {
                return false;
            }
        }
    }

    //Fin Tabla de Posiciones

    public function matches_today()
    {

        $data['title'] = "Partidos de Hoy";
        $data['scores'] = $this->mdl_scoreboards->today_matches();
        if ($data['scores'] == false) {
            $data['scores'] = $this->match_calendary->last_matches();
            $data['title'] = "Ultima Fecha";
        }

        $this->load->view('scoreboards/scoreboards_live', $data);

    }


    function list_played_matches()
    {

        $champ = $this->uri->segment(3);
        $data['champ'] = $champ;
        $data['partidos'] = $this->match_calendary->matches_last_next(FALSE, FALSE);
        $this->load->view($this->folder_views . '/list_results', $data);
    }

    public function scoreboardFull($champ, $tipoCampeonato = 'acumulada')
    {
        $this->load->module('teams_position');
        $this->load->module('contenido');
        $data['champ'] = $champ;
        $data['tipoCampeonato'] = $tipoCampeonato;
        if ($tipoCampeonato == 'acumulada') {
            $data['scroreBoardAcumulative'] = $this->scoreboards->leaderboard_cumulative($champ, "leaderboarddetail");
            $data['scroreBoardSingle'] = $this->scoreboards->leaderboard($champ, "leaderboarddetail");
            $conten = strip_tags(trim($data['scroreBoardSingle']));
            if ($conten == "Tabla vacía") {
                $data['scroreBoardSingle'] = $data['scroreBoardAcumulative'];
            }

        } else {
             $data['scroreBoardAcumulative'] = "";
            $data['scroreBoardSingle'] = $this->scoreboards->leaderboard($champ, "leaderboarddetail", $tipoCampeonato);
            $conten = strip_tags(trim($data['scroreBoardSingle']));
            if ($conten == "Tabla vacía") {
                $data['scroreBoardSingle'] = $data['scroreBoardAcumulative'];
            }
        }
        return $this->load->view('leaderboardFull', $data, true);

    }

    // Tabla de Posiciones  acumulada
    public function leaderboard_cumulative($champ, $leaderboard = 'leaderboard')
    {

        $data['change'] = array(base_url() . 'imagenes/icons/flecha_arriba.png',
            base_url() . 'imagenes/icons/igual.png',
            base_url() . 'imagenes/icons/flecha_abajo.png');

        $data['tabla'] = $this->mdl_teams_position->get_table_by_champ($champ);
        //barcelona sancion campeonato 2015.
        if ($champ == 53) {
            $data['tabla'] = $this->sancionLDUL ($data['tabla']);
            $data['tabla'] = $this->sancionBarcelona ($data['tabla']);
        }
        return $this->load->view($leaderboard, $data, true);
     }
    //Fin Tabla de Posiciones acumulada
}
