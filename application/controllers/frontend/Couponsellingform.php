<?php
class Couponsellingform extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
  }

  function index()
  {
    date_default_timezone_set('Asia/Jakarta');
    $unique_key = date('YmdHis').hrtime(true);
    $this->session->set_userdata('formuniqueid', $unique_key);

    $message = "";
    $formdata = [
      "couponNumber"=> $this->input->post('couponNumber') ? $this->input->post('couponNumber') : null,
      "memberName"=> $this->input->post('memberName') ? $this->input->post('memberName') : null,
      "memberEmail"=> $this->input->post('memberEmail') ? $this->input->post('memberEmail') : null,
      "shipperAddress"=> $this->input->post('shipperAddress') ? $this->input->post('shipperAddress') : null,
      "memberPhone"=> $this->input->post('memberPhone') ? $this->input->post('memberPhone') : null,
    ];
    // $formdata = [
    //   "couponNumber"=> $this->input->post('couponNumber') ? $this->input->post('couponNumber') : "1234",
    //   "memberName"=> $this->input->post('memberName') ? $this->input->post('memberName') : "Jhon Doe",
    //   "memberEmail"=> $this->input->post('memberEmail') ? $this->input->post('memberEmail') : "testingemail@gmail.com",
    //   "shipperAddress"=> $this->input->post('shipperAddress') ? $this->input->post('shipperAddress') : "Testing Shipper Address",
    //   "memberPhone"=> $this->input->post('memberPhone') ? $this->input->post('memberPhone') : "085746837483",
    // ];
    if ($this->input->post('submit')) {
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
          $this->session->set_userdata('member_id', $member_id);
          $this->session->set_userdata('edition_id', $edition_id);
          $this->session->set_userdata('registration_id', $registration_id);
          $this->session->set_userdata('coupon_number', $couponNumber);
          redirect(base_url() . "frontend/couponpurchase");
        } else {
          $message = "Registration Failed";
        }
      } else {
        $message = "Member Failed";
      }
    }
    $data = ['message' => $message, 'formdata' => $formdata];
    // echo json_encode($data);
    $this->load->model("modelfrontend");
    $dataHeader = $this->modelfrontend->getDataHeader();
    $this->load->view('viewfrontend/layout/header', $dataHeader);
    $this->load->view('viewfrontend/layout/leftmenu', ['showback' => true, 'showmainmenu' => false, 'showadditionalmenu' => false, 'header'=>$dataHeader]);
    $this->load->view('viewfrontend/couponsellingform', $data );
    $this->load->view('viewfrontend/layout/rightmenu', ['showmainmenu' => false]);
    $this->load->view('viewfrontend/layout/footer', ['ajaxfilename' => 'ajaxcouponsellingform.js']);
  }
}
