<?php
class Addtestimoni extends CI_Controller {
    
    function __construct() {
        parent::__construct();
    }

    function index()
    {
      $this->load->helper('common');

      $message = "";
      $formdata = [
        "edqr_code"=> $this->input->post('edqr_code') ? $this->input->post('edqr_code') : null,
        "edcoupon_id"=> $this->input->post('edcoupon_id') ? $this->input->post('edcoupon_id') : null,
        "edevent_name"=> $this->input->post('edevent_name') ? $this->input->post('edevent_name') : null,
        "edcoupon_number"=> $this->input->post('edcoupon_number') ? $this->input->post('edcoupon_number') : null,
        "edmember_name"=> $this->input->post('edmember_name') ? $this->input->post('edmember_name') : null,
        "edusername"=> $this->input->post('edusername') ? $this->input->post('edusername') : null,
        "edtestimoni_text"=> $this->input->post('edtestimoni_text') ? $this->input->post('edtestimoni_text') : '',
        "edtestimoni_photo"=> $this->input->post('edtestimoni_photo') ? $this->input->post('edtestimoni_photo') : null,
      ];
      if ($this->input->post('submit')) {      
        $this->load->model('modeltestimonials');
        $this->load->model('modeltestimoni_photos');

        $coupon_id = $this->input->post('edcoupon_id');
        $event_name = $this->input->post('edevent_name');
        $coupon_number = $this->input->post('edcoupon_number');
        $username = $this->input->post('edusername');
        $testimoni_text = $this->input->post('edtestimoni_text');
        $testimoni_photo = $this->input->post('edtestimoni_photo');
        
        $response_db =  $this->modeltestimonials->setInserttestimonials(0, $coupon_id, $coupon_number, $event_name, $username, $testimoni_text);

        
        if (isset($response_db['error'])) {
          $message = 'Coupon anda sudah dipakai untuk upload komentar.';
        } else {
          $xtestimoni_id = $response_db;
  
          $xStr =  $this->modeltestimoni_photos->setInserttestimoni_photos(0, $xtestimoni_id, $testimoni_photo);
        }
      }

      $data = ['message' => $message, 'formdata' => $formdata];

      $this->load->model("modelfrontend");
      $dataHeader = $this->modelfrontend->getDataHeader();

      $this->load->view('viewfrontend/layout/header', $dataHeader);
      $this->load->view('viewfrontend/layout/leftmenu', ['showback' => false, 'showmainmenu' => true, 'showadditionalmenu' => false, 'header'=>$dataHeader]);
      $this->load->view('viewfrontend/addtestimoni', $data);
      $this->load->view('viewfrontend/layout/rightmenu', ['showmainmenu' => true]);
      $this->load->view('viewfrontend/layout/footer', ['ajaxfilename'=> 'ajaxaddtestimoni.js']);
    }
 
}