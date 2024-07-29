<?php
class Testimonials extends CI_Controller {
    
    function __construct() {
        parent::__construct();
    }

    function index()
    {
      $this->load->helper('common');
      
      $this->load->model("modelevents");
      $row_event = $this->modelevents->getActiveEvent();
      $event_id = $row_event->idx;

      $this->load->model("modeltestimonials");
      $limit = 1000;
      $list_testimonials = $this->modeltestimonials->getListtestimonialsByEvent($event_id, $limit);

      $this->load->model("modelfrontend");
      $dataHeader = $this->modelfrontend->getDataHeader();

      $data = ['event'=>$row_event, 'list_testimonials'=>$list_testimonials];   

      $this->load->view('viewfrontend/layout/header', $dataHeader);
      $this->load->view('viewfrontend/layout/leftmenu', ['showback' => false, 'showmainmenu' => true, 'showadditionalmenu' => false, 'header'=>$dataHeader]);
      $this->load->view('viewfrontend/testimonials', $data);
      $this->load->view('viewfrontend/layout/rightmenu', ['showmainmenu' => true]);
      $this->load->view('viewfrontend/layout/footer', ['ajaxfilename'=> 'ajaxcollabolators.js']);
    }
 
}