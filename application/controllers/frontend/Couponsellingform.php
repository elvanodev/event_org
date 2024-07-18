<?php
class Couponsellingform extends CI_Controller {
    
    function __construct() {
        parent::__construct();
    }

    function index()
    {
      $this->load->model("modelfrontend");
      $dataHeader = $this->modelfrontend->getDataHeader();
      $this->load->view('viewfrontend/layout/header', $dataHeader);
      $this->load->view('viewfrontend/layout/leftmenu', ['showback' => true, 'showmainmenu' => false, 'showadditionalmenu' => false]);
      $this->load->view('viewfrontend/couponsellingform', );
      $this->load->view('viewfrontend/layout/rightmenu', ['showmainmenu' => false]);
      $this->load->view('viewfrontend/layout/footer', ['ajaxfilename'=> 'ajaxcouponsellingform.js']);
    }

    function detectCouponNumberExist() {
      $this->load->model('modelcoupons');
      $this->modelcoupons->getDetailcouponBycoupon_number($this->input->post(''));
    }

    function save() {
      $this->load->helper("common");
      $this->load->helper("qrcode");
      $this->load->model("modelmembers");
      $this->load->model("modelregistrations");
      $this->load->model("modelcoupons");      
      $edition_id = $this->session->userdata("edition_id");
      
      $couponNumber = $this->input->post('couponNumber');
      $memberName = $this->input->post('memberName');
      $memberEmail = $this->input->post('memberEmail');
      $shipperAddress = $this->input->post('shipperAddress');
      $memberPhone = $this->input->post('memberPhone');
      $xpassword = md5($couponNumber);
      // echo json_encode([$couponNumber,$memberName,$memberEmail,$shipperAddress,$memberPhone,$xpassword]);

      // Create/Update Member
      $rowMember = $this->modelmembers->getDetailmembersbyemail($memberEmail);
      $member_id = 0;
      if ($rowMember) {
        $member_id = $rowMember->idx;
        $this->modelmembers->setUpdatemembers1($member_id, $memberName, $memberEmail, $shipperAddress, $memberPhone);
        $this->modelregistrations->setDeleteregistrationsbymemberandedition($edition_id, $rowMember->idx);
      } else {
        $member_id = $this->modelmembers->setInsertmembers($memberName, $memberEmail, $xpassword, $shipperAddress, $memberPhone);
      }

      // Register Member to Event Edition
      if ($member_id != 0) {
        $rowRg = $this->modelregistrations->getDetailregistrationsByEditionAndMember($edition_id, $member_id);
        if ($rowRg) {
          $registration_id = $rowRg->idx;
          $this->modelregistrations->setUpdateregistrations($registration_id, $edition_id, $member_id, null);
        } else {    
          $prefix = "ED".$edition_id."_"."M".$member_id;
          $xqr_code = generate_qrcode($prefix, true, 10);

          $registration_id = $this->modelregistrations->setInsertregistrations($edition_id, $member_id, null, $xqr_code);
        }

        //Populate Coupon
        if ($registration_id != 0) {          
          $prefix = "ED".$edition_id."_"."RG".$registration_id;
          $xqr_code_coupon = generate_qrcode($prefix, false, 0, $couponNumber);
          
        }
      }
    }

  
}