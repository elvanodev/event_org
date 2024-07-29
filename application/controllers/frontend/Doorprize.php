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
      $list_doorprize = $this->modeldoorprize->getListdoorprizeByEvent($event_id);

      $this->load->model("modelfrontend");
      $dataHeader = $this->modelfrontend->getDataHeader();

      $data = ['event'=>$row_event, 'list_doorprize'=>$list_doorprize];   

      $this->load->view('viewfrontend/layout/header', $dataHeader);
      $this->load->view('viewfrontend/layout/leftmenu', ['showback' => false, 'showmainmenu' => true, 'showadditionalmenu' => false, 'header'=>$dataHeader]);
      $this->load->view('viewfrontend/doorprize', $data);
      $this->load->view('viewfrontend/layout/rightmenu', ['showmainmenu' => true]);
      $this->load->view('viewfrontend/layout/footer', ['ajaxfilename'=> 'ajaxdoorprize.js']);
    }
 
}