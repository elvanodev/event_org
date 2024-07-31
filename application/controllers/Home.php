<?php
class Home extends CI_Controller {
    
    function __construct() {
        parent::__construct();
    }

    function index()
    {
      $this->load->model("modelevents");
      $row_event = $this->modelevents->getActiveEvent();
      $event_id = $row_event->idx;

      $this->load->model("modeltestimonials");
      $limit = 5;
      $list_testimonials = $this->modeltestimonials->getListtestimonialsByEvent($event_id, $limit);

      $data = ['event'=>$row_event, 'list_testimonials'=>$list_testimonials];   

      $this->load->model("modelfrontend");
      $dataHeader = $this->modelfrontend->getDataHeader();
      $this->load->view('viewfrontend/layout/header', $dataHeader);
      $this->load->view('viewfrontend/layout/leftmenu', ['showback' => false, 'showmainmenu' => true, 'showadditionalmenu' => true, 'header'=>$dataHeader, 'active_home' => 'menu-active']);
      $this->load->view('viewfrontend/home', $data);
      $this->load->view('viewfrontend/layout/rightmenu', ['showmainmenu' => true]);
      $this->load->view('viewfrontend/layout/footer', ['ajaxfilename'=> 'ajaxhome.js']);
    }

    function seteditionsession() {
      $xedition_id = $_POST['ededition_id'];
      $this->session->set_userdata('edition_id', $xedition_id);

      echo json_encode(null);
    }
  
}