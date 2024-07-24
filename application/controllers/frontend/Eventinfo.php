<?php
class Eventinfo extends CI_Controller {
    
    function __construct() {
        parent::__construct();
    }

    function index()
    {
      $this->load->model("modelfrontend");
      $dataHeader = $this->modelfrontend->getDataHeader();
      $this->load->view('viewfrontend/layout/header', $dataHeader);
      $this->load->view('viewfrontend/layout/leftmenu', ['showback' => false, 'showmainmenu' => true, 'showadditionalmenu' => false]);
      $this->load->view('viewfrontend/eventinfo', $dataHeader);
      $this->load->view('viewfrontend/layout/rightmenu', ['showmainmenu' => true]);
      $this->load->view('viewfrontend/layout/footer', ['ajaxfilename'=> 'ajaxcollabolators.js']);
    }

    function detail()
    {
      $collaboratorid = $this->input->post("collaboratorid");

      $this->load->model("modelcollabolators");
      $row = $this->modelcollabolators->getDetailcollabolators($collaboratorid);
      echo json_encode($row);
    }
  
}