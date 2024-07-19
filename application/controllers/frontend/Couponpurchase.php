<?php
class Couponpurchase extends CI_Controller {
    
    function __construct() {
        parent::__construct();
    }

    function index()
    {
      if ($this->session->userdata('formuniqueid')) {
        $edition_id = $this->session->userdata("edition_id");
        $member_id = $this->session->userdata('member_id');
        $edition_id = $this->session->userdata('edition_id');
        $registration_id = $this->session->userdata('registration_id');
        $coupon_number = $this->session->userdata('coupon_number');

        $this->load->model('modeleditions');
        $this->load->model('modelshippers');
        $rowEdition = $this->modeleditions->getDetaileditions($edition_id);
        $arrayongkir = $this->modelshippers->getArrayListshippers();

        $message = "";
        $formdata = [
          "selected_coupon_number"=> $coupon_number,
          "arrayongkir"=> $arrayongkir,
          "selected_ongkir"=> $arrayongkir,

        ];
        if ($this->input->post('submit')) {
          $this->load->helper("common");
          $this->load->helper("qrcode");
          $this->load->model("modelmembers");
          $this->load->model("modelregistrations");
          $this->load->model("modelcoupons");
    
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
              $prefix = "REG-ED" . $edition_id . "_" . "M" . $member_id;
              $xqr_code = generate_qrcode($prefix);
    
              $registration_id = $this->modelregistrations->setInsertregistrations($edition_id, $member_id, null, $xqr_code);
            }
    
            //Populate Coupon
            if ($registration_id != 0) {
              redirect(base_url() . "frontend/couponpurchase");
            } else {
              $message = "Registration Failed";
            }
          } else {
            $message = "Member Failed";
          }
        }
        $this->load->model("modelfrontend");
        $dataHeader = $this->modelfrontend->getDataHeader();
        $this->load->view('viewfrontend/layout/header', $dataHeader);
        $this->load->view('viewfrontend/layout/leftmenu', ['showback' => true, 'showmainmenu' => false, 'showadditionalmenu' => false]);
        $this->load->view('viewfrontend/couponpurchase', $data );
        $this->load->view('viewfrontend/layout/rightmenu', ['showmainmenu' => false]);
        $this->load->view('viewfrontend/layout/footer', ['ajaxfilename'=> 'ajaxcouponpurchase.js']);
      } else {
        redirect(404);
      }
    }
  
}