<?php
class Home extends CI_Controller {
    
    function __construct() {
        parent::__construct();
    }

    function index()
    {
      $this->load->view('frontend/layout/header');
      $this->load->view('frontend/home');
      $this->load->view('frontend/layout/footer');
    }
  
}