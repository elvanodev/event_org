<?php
class Home extends CI_Controller {
    
    function __construct() {
        parent::__construct();
    }

    function index()
    {
      $this->load->view('viewfrontend/layout/header');
      $this->load->view('viewfrontend/home');
      $this->load->view('viewfrontend/layout/footer');
    }
  
}