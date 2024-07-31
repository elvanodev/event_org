<?php
class Eventinfo extends CI_Controller {
    
    function __construct() {
        parent::__construct();
    }

    function index()
    {
      $this->load->helper('common');
      
      $this->load->model("modelevents");
      $row_event = $this->modelevents->getActiveEvent();
      $event_id = $row_event->idx;

      $this->load->model("modelfaq");
      $list_faqs = $this->modelfaq->getListfaqByEvent($event_id);

      $this->load->model("modelfrontend");
      $dataHeader = $this->modelfrontend->getDataHeader();
      $row_event->agent_open_date = mysqltodate($row_event->agent_open_date);
      $row_event->agent_close_date = mysqltodate($row_event->agent_close_date);
      $row_event->agent_open_time = substr($row_event->agent_open_time, 0, 5);
      $row_event->agent_close_time = substr($row_event->agent_close_time, 0, 5);

      $data = ['event'=>$row_event, 'list_faqs'=>$list_faqs];   

      $this->load->view('viewfrontend/layout/header', $dataHeader);
      $this->load->view('viewfrontend/layout/leftmenu', ['showback' => false, 'showmainmenu' => true, 'showadditionalmenu' => false, 'header'=>$dataHeader, 'active_info' => 'menu-active']);
      $this->load->view('viewfrontend/eventinfo', $data);
      $this->load->view('viewfrontend/layout/rightmenu', ['showmainmenu' => true]);
      $this->load->view('viewfrontend/layout/footer', ['ajaxfilename'=> '']);
    }
 
}