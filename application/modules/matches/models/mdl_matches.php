<?php

class Mdl_matches extends MY_Model
{


    public $table_name = "matches";
    public $primary_key = "id";
    public $joins;
    public $select_fields;
    public $total_rows;
    public $page_links;
    public $current_page;
    public $num_pages;
    public $optional_params;
    public $order_by;
    public $form_values = array();

    public function __construct()
    {
        parent::__construct();
    }

    function matches_id($id)
    {
        // Todo el calendario
        $query = $this->db->query('Select m.*, m.date_match as dm, c.name as cn, r.name as rn, g.name as gn, s.season as sn, s.position as sp, mt.team_id_home as hid, mt.team_id_away as aid, st.name, t.name hname, t1.name aname, r.id as rid, g.id as gid
								 From matches as m, groups as g, rounds as r, championships as c, schedules as s, matches_teams as mt, stadia as st, teams as t, teams as t1
								 Where mt.match_id=m.id AND mt.team_id_home=t.id AND mt.team_id_away=t1.id AND m.id = ' . $id . '
									   AND m.group_id=g.id AND g.round_id=r.id AND r.championship_id=c.id AND c.active_round=r.id AND st.id=m.stadia_id AND m.schedule_id = s.id
								 Order by cn asc, sp desc, dm asc, gn asc');
        if ($query->num_rows() == 0)
            return NULL;
        $teams = array();
        // separamos por fechas
        $fechaSub = "";
        foreach ($query->result() as $row):
            $teams[$row->sn][] = $row;
        endforeach;
        return $teams;
    }

    function matches_all($championship)
    {
        // Todo el calendario
        $query = $this->db->query('Select m.*, m.date_match as dm, c.name as cn, r.name as rn, g.name as gn, s.season as sn, s.position as sp, mt.team_id_home as hid, mt.team_id_away as aid, st.name, t.name hname, t1.name aname, r.id as rid, g.id as gid
								 From matches as m, groups as g, rounds as r, championships as c, schedules as s, matches_teams as mt, stadia as st, teams as t, teams as t1
								 Where mt.match_id=m.id AND mt.team_id_home=t.id AND mt.team_id_away=t1.id AND m.schedule_id IN (SELECT sch.id
																	    														 FROM   (SELECT round_id, s.position as p
																																									FROM schedules AS s, championships AS ch
																																									WHERE s.round_id = ch.active_round AND ch.id=' . $championship . '
																																									ORDER BY p DESC) as s, schedules as sch
																																 WHERE s.p=sch.position AND s.round_id=sch.round_id)
									   AND m.group_id=g.id AND g.round_id=r.id AND r.championship_id=c.id AND c.active_round=r.id AND st.id=m.stadia_id AND m.schedule_id = s.id
								 Order by cn asc, sp desc, dm asc, gn asc');
        if ($query->num_rows() == 0)
            return NULL;
        $teams = array();
        // separamos por fechas
        $fechaSub = "";
        foreach ($query->result() as $row):
            $teams[$row->sn][] = $row;
        endforeach;
        return $teams;
    }

    function get_pics_teams($id)
    {
        $query = $this->db->query('Select  DISTINCT(t.id) as id ,t.shield, t.shield2
    					  		 From championships as c, teams  as t, championships_teams as ct, images as i
    					  		 Where c.id=' . $id . '
    					  		   And c.id=ct.championship_id
    					  		   And t.id=ct.team_id');

        if ($query->num_rows() == 0)
            return NULL;

        $teams = '';

        foreach ($query->result() as $row):
            $teams['shield'][$row->id] = $row->shield;
            $teams['shield2'][$row->id] = $row->shield2;
        endforeach;

        return $teams;
    }

    function get_match_teams($id)
    {
        $query = $this->db->query("select * from matches_teams where match_id  = $id;");
        if ($query->num_rows() == 0)
            return NULL;
        return $query->result();
    }

    function get_info_team($id)
    {
        $query = $this->db->query("select * from teams where id  = $id;");
        if ($query->num_rows() == 0)
            return NULL;
        $result = $query->result();
        return $result[0];
    }

    function get_goals_team($match_id, $team_id)
    {
        $query = $this->db->query("SELECT
                                        players.first_name,
                                        players.last_name,
	                                      goals.minute
                                    FROM goals INNER JOIN players ON goals.player_id = players.id where match_id = $match_id and team_id = $team_id;");
        if ($query->num_rows() == 0)
            return NULL;
        $result = $query->result();
        return $result;
    }

    function get_estrategia_team($match_id, $team_id)
    {
        $query = $this->db->query("SELECT CONCAT( SUM(IF(position='Defensa',1,0)), '-', SUM(IF(position='Volante',1,0)) ,'-', SUM(IF(position='Delantero',1,0)) ) as res
								   FROM lineups
								   WHERE match_id=$match_id and team_id=$team_id and (status=1 OR status=2)");
        if ($query->num_rows() == 0)
            return NULL;
        $result = $query->result();
        return $result[0]->res;
    }

    function get_titulares_team($match_id, $team_id)
    {
        $query = $this->db->query("SELECT p.first_name, p.last_name, p.nick, l.position, l.status, l.match_id, p.id, l.status %2 AS s,
										   if(l.position='Arquero',1,if(l.position='Defensa',2,if(l.position='Volante',3,4))) as pos
								    FROM players AS p, lineups AS l
								    WHERE p.id = l.player_id AND l.match_id =$match_id  AND l.team_id=$team_id
								    ORDER BY s DESC , pos ASC, p.last_name ASC, p.first_name ASC");

        if ($query->num_rows() == 0)
            return NULL;
        $result = $query->result();
        return $result;
    }

    function get_actions_team($match_id)
    {
        $tipo['cambio'] = base_url() . 'imagenes/icons/mccambio.png';
        $tipo['falta'] = base_url() . 'imagenes/icons/mcfalta.png';
        $tipo['gol'] = base_url() . 'imagenes/icons/mcgol.png';
        $tipo['penal'] = base_url() . 'imagenes/icons/mcpenal.png';
        $tipo['pitazo'] = base_url() . 'imagenes/icons/mcpitazo.png';
        $tipo['tarjeta'] = base_url() . 'imagenes/icons/mctarjeta.png';

        $query = $this->db->query("Select match_time, type, text
									  From actions
									  Where match_id= $match_id
									  Order by match_time DESC");


        if ($query->num_rows() == 0)
            return NULL;
        $resultado = array();
        foreach ($query->result() as $row) {
            if ($row->type == 'cambio' || $row->type == 'falta' || $row->type == 'gol' || $row->type == 'penal' || $row->type == 'pitazo' || $row->type == 'tarjeta')
                $type = $tipo[$row->type];
            else
                $type = base_url() . 'imagenes/icons/arbitro.png';
            if ($row->match_time != 200)
                $min = $row->match_time;
            else
                $min = "--";

            array_push($resultado, array(
                'minuto' => $min,
                'tipo' => $type,
                'texto' => $row->text));
        }


        return $resultado;
    }

    //todo las siguientes funciones no se si usan


    function today_matches($live = 'live')
    {   //Todo partido q se juega hoy

        $this->db->select('*, UNIX_TIMESTAMP(date_match) as hour', false);
        $this->db->from('matches');
        $this->db->where('DATE(date_match)', 'CURDATE()', false);
        if ($live == 'live')
            $this->db->where('live', '1');
        $this->db->order_by('date_match', 'desc');
        $matches = $this->db->get();

        //Chequeo si existen partidos
        if ($matches->num_rows() > 0)
            $partidos = $this->data_matches($matches);
        else
            $partidos = false;

        return $partidos;
    }

    /*
     * ULTIMOS PARTIDOS DE UNA FECHA DE UN CAMPEONATO */

    function last_matches($champ = 0)
    {

        $this->db->select('schedules.*,championships.name');
        $this->db->from('schedules');
        $this->db->join('championships', 'schedules.round_id=championships.active_round');
        if ($champ > 0)
            $this->db->where('championships.id', $champ);
        $this->db->order_by('schedules.round_id', 'asc');
        $this->db->order_by('schedules.position', 'asc');
        $schedules = $this->db->get();

        //Saco las ultimas fechas jugadas de el/los campeonatos
        $aux = 0;
        $fechas = array();
        foreach ($schedules->result() as $schedule) {
            if ($schedule->round_id != $aux) {
                $fechas[] = $schedule->id;
                $aux = $schedule->round_id;
            }
        }

        //Saco todos los partidos en vivo de las fechas
        $this->db->select('*, UNIX_TIMESTAMP(date_match) as hour', false);
        $this->db->where('live', '1');
        $this->db->where_in('state', array('0', '8'));
        $this->db->where_in('schedule_id', $fechas);
        $this->db->order_by('date_match', 'desc');
        $matches = $this->db->get('matches');

        if ($matches->num_rows() > 0)
            $partidos = $this->data_matches($matches);
        else
            $partidos = false;

        return $partidos;
    }


    /* Extraigo los datos básicos del partido */

    function data_matches($matches)
    {
        $partidos = array();
        foreach ($matches->result() as $key => $match) {
            //Datos del Partido
            $partidos[$key] = $match;
            $this->db->where('match_id', $match->id);
            $teams = current($this->db->get('matches_teams')->result());
            $partidos[$key]->hid = $teams->team_id_home;
            $partidos[$key]->aid = $teams->team_id_away;

            //Campeonato
            $this->db->select('championships.*,groups.id as gid');
            $this->db->from('groups');
            $this->db->join('rounds', 'rounds.id=groups.round_id');
            $this->db->join('championships', 'championships.id=rounds.championship_id');
            $this->db->where('groups.id', $match->group_id);
            $championship = current($this->db->get()->result());
            $partidos[$key]->championship = $championship->name;
            $partidos[$key]->group_id = $championship->gid;

            //Equipo Local
            $this->db->where('id', $partidos[$key]->hid);
            $team_home = current($this->db->get('teams')->result());
            $partidos[$key]->hname = $team_home->name;
            $partidos[$key]->hsname = $team_home->short_name;
            $partidos[$key]->hshield = 'imagenes/teams/shield/default.png';
            $partidos[$key]->hthumb = 'imagenes/teams/thumb_shield/default.png';
            if ($team_home->shield != '')
                $partidos[$key]->hshield = $team_home->shield;
            if ($team_home->thumb_shield != '') {
                $partidos[$key]->hthumb = $team_home->thumb_shield2;
                $partidos[$key]->mhthumb = $team_home->mini_shield;
            }
            //Equipo Visitante
            $this->db->where('id', $partidos[$key]->aid);
            $team_away = current($this->db->get('teams')->result());
            $partidos[$key]->aname = $team_away->name;
            $partidos[$key]->asname = $team_away->short_name;
            $partidos[$key]->ashield = 'imagenes/teams/shield/default.png';
            $partidos[$key]->athumb = 'imagenes/teams/thumb_shield/default.png';
            if ($team_away->shield2 != '')
                $partidos[$key]->ashield = $team_away->shield2;
            if ($team_away->thumb_shield2 != '') {
                $partidos[$key]->athumb = $team_away->thumb_shield2;
                $partidos[$key]->mathumb = $team_away->mini_shield;
            }
        }
        return $partidos;
    }

    //listado de partidos de la semana
    function list_mwatch_week($championship)
    {
        $this->output->cache(CACHE_MOVIL);
        $partidos = $this->matches_last_next($championship, TRUE);
        return $partidos;
    }

    //listado de partidos de la semana
    function list_mwatch_results($championship)
    {
        $this->output->cache(CACHE_MOVIL);
        $partidos = $this->matches_last_next($championship, FALSE);
        return $partidos;
    }

    function matches_last_next($championship, $next)
    {

        $active_schedules = $this->active_schedules($championship, $next);

        $champs = array();
        $sch_ids = "";
        foreach ($active_schedules as $schedule) {
            $champs[$schedule->id] = array('id' => $schedule->champ, 'name' => $schedule->name);
            $sch_ids .= $schedule->id . ',';
        }
        $sch_ids = reduce_multiples($sch_ids, ",", TRUE);

        $matches = $this->db->query('SELECT m.*, UNIX_TIMESTAMP(m.date_match) as dm, mt.team_id_home as hid, mt.team_id_away as aid, st.name, t.name hname,t.mini_shield hshield, t1.name aname,t1.mini_shield ashield
								 	FROM matches as m,matches_teams as mt, stadia as st, teams as t, teams as t1
								 	WHERE mt.match_id=m.id AND mt.team_id_home=t.id AND mt.team_id_away=t1.id AND m.schedule_id IN (' . $sch_ids . ')
										AND st.id=m.stadia_id
								 	ORDER BY dm asc')->result();

        $data = array();
        $i = 0;
        foreach ($matches as $match) {
            //validar el logo

            if ($match->hshield == '') $match->hshield = "imagenes/teams/mini_shields/default.jpg";
            if ($match->ashield == '') $match->ashield = "imagenes/teams/mini_shields/default.jpg";
            $data[$i] = $match;
            $data[$i]->cn = $champs[$match->schedule_id]['name'];
            $data[$i]->cid = $champs[$match->schedule_id]['id'];
            $champ[$i] = $champs[$match->schedule_id]['id'];
            $dates[$i] = $match->dm;
            $i++;
        }

        array_multisort($champ, SORT_ASC, $dates, SORT_ASC, $data);

        return $data;

    }

    public function active_schedules($championship, $next)
    {

        // Partidos q se jugaron en la fecha anterior o la siguiente fecha
        //$this->load->helper('string');

        if ($championship != FALSE) {
            $donde = 'AND ch.id=' . $championship;
        } else {
            $donde = '';
        }
        if ($next) {
            $sig = 'MAX';
        } else {
            $sig = 'MIN';
        }

        //Selecciona el minimo del schedule fecha actual de la ronda activa del o los campeonatos
        //Selecciona  solo el id de la fecha
        //Seleciona todos los partidos con equipos grupo ronda campeonato de esa fecha de cada campeonaro
        //Selecciona los nombres de los equipos

        return $this->db->query('SELECT sch.id,s.champ,s.name
    										 FROM   (SELECT round_id,' . $sig . '( s.position ) as p,ch.id as champ,ch.name
																				FROM schedules AS s, championships AS ch
																				WHERE s.round_id = ch.active_round ' . $donde . '
																				GROUP BY s.round_id) as s, schedules as sch
											 WHERE s.p=sch.position AND s.round_id=sch.round_id ORDER BY  s.name')->result();

    }
}