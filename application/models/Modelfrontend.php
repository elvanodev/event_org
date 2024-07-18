<?php
class modelfrontend extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }

    function getDataHeader() {
      $this->load->model("modelevents");
      $row_event = $this->modelevents->getActiveEvent();

      $event_id = $row_event->idx;
      $this->load->model("modeleditions");
      $list_editions = $this->modeleditions->getListeditionsByEvent($event_id);

      $selected_edition = $this->session->userdata('edition_id');
      if (!$selected_edition) {
        $this->session->set_userdata('edition_id', $list_editions[0]->idx);
      }
      $selected_edition = $this->session->userdata('edition_id');
      
      $data_header = ['event'=>$row_event, 'editions'=>$list_editions, 'selected_edition'=>$selected_edition];   
      return $data_header;
    }

}