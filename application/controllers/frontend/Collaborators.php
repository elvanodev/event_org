<?php
class Collaborators extends CI_Controller {
    
    function __construct() {
        parent::__construct();
    }

    function index()
    {
      $this->load->model("modelcollabolators");
      $edition_id = $this->session->userdata("edition_id");
      $queryCollaborators = $this->modelcollabolators->getListcollabolatorsbyedition_id($edition_id);
      $listCollaborators = $queryCollaborators->result();
      $data = ['list_collaborators'=>$listCollaborators];
      $this->load->model("modelfrontend");
      $dataHeader = $this->modelfrontend->getDataHeader();
      $this->load->view('viewfrontend/layout/header', $dataHeader);
      $this->load->view('viewfrontend/layout/leftmenu', ['showback' => false, 'showmainmenu' => true, 'showadditionalmenu' => false]);
      $this->load->view('viewfrontend/collaborators', $data);
      $this->load->view('viewfrontend/layout/rightmenu', ['showmainmenu' => true]);
      $this->load->view('viewfrontend/layout/footer', ['ajaxfilename'=> 'ajaxcollabolators.js']);
    }
  
}