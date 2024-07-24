<?php
class Eventinfo extends CI_Controller {
    
    function __construct() {
        parent::__construct();
    }

    function index()
    {
      $this->load->helper('common');
      $this->load->model("modelfrontend");
      $dataHeader = $this->modelfrontend->getDataHeader();
      // $dataHeader->agent_open_date = mysqltodate($dataHeader->agent_open_date);
      // $dataHeader->agent_close_date = mysqltodate($dataHeader->agent_close_date);
      $this->load->view('viewfrontend/layout/header', $dataHeader);
      $this->load->view('viewfrontend/layout/leftmenu', ['showback' => false, 'showmainmenu' => true, 'showadditionalmenu' => false]);
      $this->load->view('viewfrontend/eventinfo', $dataHeader);
      $this->load->view('viewfrontend/layout/rightmenu', ['showmainmenu' => true]);
      $this->load->view('viewfrontend/layout/footer', ['ajaxfilename'=> 'ajaxcollabolators.js']);
    }
 
}