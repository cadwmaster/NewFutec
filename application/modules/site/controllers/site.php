<?php

class Site extends MY_Controller
{
    public $model = FALSE;
    public $data = array();

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->home();
    }


    public function home()
    {

        // para la final se comentan la llamada a las secciones.

        //$this->output->cache(30);


        $this->load->module('noticias');
        $this->load->module('templates');
        $this->load->module('contenido');
        $this->load->module('banners');

        $data['pageTitle'] = "futbolecuador.com - Lo mejor del fútbol ecuatoriano";

        $this->load->library('user_agent');

        $mobiles = array('Apple iPhone', 'Generic Mobile', 'SymbianOS');
        $isMobile = false;
        if ($this->agent->is_mobile()) {
            $m = $this->agent->mobile();
            if (in_array($m, $mobiles))
                $isMobile = true;
        }

        /* if ($isMobile) {

             $data['cabecera'] = $this->contenido->menum();

             $data['content'] = $this->contenido->header_mobile();
             //$data['content'] .= $this->partidos->partidosFechaMovil();
             $data['content'] .= $this->partidos->partidosFinal();
             $data['content'] .= $this->contenido->view_banner_contenidotop();
             $data['content'] .= $this->contenido->view_noticia_home();
             $data['content'] .= $this->contenido->view_banner_contenido();
             $data['content'] .= $this->contenido->view_twitter();

             $data['footer'] = '';

             $data['sidebar'] = '';

         } else {*/

        $data['top1'] = $this->banners->top1();
        $data['header1'] = $this->contenido->menu();

        $dataHeader2['FE_Bigboxbanner'] = $this->banners->FE_Bigboxbanner();
        $data['header2'] = $this->contenido->header2($dataHeader2);
        $data['top2'] = $this->banners->FE_Megabanner();

        $data['content'] = $this->noticias->viewNoticiasHome();
        $data['sidebar'] = $this->contenido->sidebar();

        $data['footer'] = $this->contenido->footer();
        $data['bottom'] = $this->contenido->bottom();


        /*   }*/
        $this->templates->_index($data);
    }
}