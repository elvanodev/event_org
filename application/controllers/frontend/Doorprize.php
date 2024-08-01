<?php
class Doorprize extends CI_Controller {
    
    function __construct() {
        parent::__construct();
    }

    function index()
    {
      $this->load->helper('common');
      
      $this->load->model("modelevents");
      $row_event = $this->modelevents->getActiveEvent();
      $event_id = $row_event->idx;

      $this->load->model("modeldoorprize");
      $row_doorprize = $this->modeldoorprize->getDetaildoorprizeByEvent($event_id);
      $list_doorprize_artists = $this->modeldoorprize->getListdoorprize_artistBydoorprizeid($row_doorprize->idx);

      $this->load->model("modelfrontend");
      $dataHeader = $this->modelfrontend->getDataHeader();

      $data = ['event'=>$row_event, 'row_doorprize'=>$row_doorprize, 'list_doorprize_artists'=>$list_doorprize_artists];   

      $this->load->view('viewfrontend/layout/header', $dataHeader);
      $this->load->view('viewfrontend/layout/leftmenu', ['showback' => false, 'showmainmenu' => true, 'showadditionalmenu' => false, 'header'=>$dataHeader]);
      $this->load->view('viewfrontend/doorprize', $data);
      $this->load->view('viewfrontend/layout/rightmenu', ['showmainmenu' => true, 'active_doorprize' => 'menu-active']);
      $this->load->view('viewfrontend/layout/footer', ['ajaxfilename'=> 'ajaxdoorprize.js']);
    }
 
}