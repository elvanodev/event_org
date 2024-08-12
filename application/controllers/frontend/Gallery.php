<?php
class Gallery extends CI_Controller {
    
    function __construct() {
        parent::__construct();
    }

    function index()
    {
      $this->load->helper('common');
      
      $this->load->model("modelevents");
      $row_event = $this->modelevents->getActiveEvent();
      $event_id = $row_event->idx;

      $this->load->model("modeleditions");
      $this->load->model("modelgalleries");
      $list_editions = $this->modeleditions->getListeditionsByEvent($event_id);
      foreach ($list_editions as $row) {
        $row->list_galleries = $this->modelgalleries->getListgalleriesByEdition($row->idx); 
      }

      $this->load->model("modelfrontend");
      $dataHeader = $this->modelfrontend->getDataHeader();

      $data = ['list_galleries_edition'=>$list_editions];   
      
      $this->load->view('viewfrontend/layout/header', $dataHeader);
      $this->load->view('viewfrontend/layout/leftmenu', ['showback' => false, 'showmainmenu' => true, 'showadditionalmenu' => false, 'header'=>$dataHeader]);
      $this->load->view('viewfrontend/gallery', $data);
      $this->load->view('viewfrontend/layout/rightmenu', ['showmainmenu' => true, 'active_gallery' => 'menu-active']);
      $this->load->view('viewfrontend/layout/footer', ['ajaxfilename'=> '']);
    }
 
}