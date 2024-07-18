<?php
class Couponselling extends CI_Controller {
    
    function __construct() {
        parent::__construct();
    }

    function index()
    {
      $this->load->model("modelfrontend");
      $dataHeader = $this->modelfrontend->getDataHeader();
      $this->load->view('viewfrontend/layout/header', $dataHeader);
      $this->load->view('viewfrontend/layout/leftmenu', ['showback' => true, 'showmainmenu' => false, 'showadditionalmenu' => false]);
      $this->load->view('viewfrontend/couponselling');
      $this->load->view('viewfrontend/layout/rightmenu', ['showmainmenu' => false]);
      $this->load->view('viewfrontend/layout/footer', ['ajaxfilename'=> '']);
    }

    function getDataHeader() {
      $this->load->model("modelevents");
      $row_event = $this->modelevents->getActiveEvent();

      $event_id = $row_event->idx;
      $this->load->model("modeleditions");
      $list_editions = $this->modeleditions->getListeditionsByEvent($event_id);
      
      $data_header = ['event'=>$row_event, 'editions'=>$list_editions];      
      return $data_header;
    }
  
}