<?php
class Home extends CI_Controller {
    
    function __construct() {
        parent::__construct();
    }

    function index()
    {
      $this->load->model("modelfrontend");
      $dataHeader = $this->modelfrontend->getDataHeader();
      $this->load->view('viewfrontend/layout/header', $dataHeader);
      $this->load->view('viewfrontend/layout/leftmenu', ['showback' => false, 'showmainmenu' => true, 'showadditionalmenu' => true]);
      $this->load->view('viewfrontend/home');
      $this->load->view('viewfrontend/layout/rightmenu', ['showmainmenu' => true]);
      $this->load->view('viewfrontend/layout/footer', ['ajaxfilename'=> 'ajaxhome.js']);
    }

    function seteditionsession() {
      $xedition_id = $_POST['ededition_id'];
      $this->session->set_userdata('edition_id', $xedition_id);

      echo json_encode(null);
    }
  
}