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
  
}