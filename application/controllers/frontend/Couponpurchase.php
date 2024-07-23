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
        $registration_id = $this->session->userdata('registration_id');
        $coupon_number = $this->session->userdata('coupon_number');

        $this->load->model('modeleditions');
        $this->load->model('modelshippers');
        $rowEdition = $this->modeleditions->getDetaileditions($edition_id);
        $arrayongkir = $this->modelshippers->getArrayListshippers();
        $shipper_id_default = 1;
        $rowShipperDefault = $this->modelshippers->getDetailshippers($shipper_id_default);

        $message = "";
        $coupon_price = $rowEdition->coupon_price;
        $total_price = $rowShipperDefault->shipper_price + $coupon_price;
        $formdata = [
          "selected_coupon_number"=> $coupon_number,
          "arrayongkir"=> $arrayongkir,
          "coupon_price"=> "Rp" . number_format($coupon_price),
          "shipper_id"=> $this->input->post('shipper_id') ? $this->input->post('shipper_id') : '1',
          "total_price"=> $this->input->post('total_price') ? $this->input->post('total_price') : "Rp".number_format($total_price),
          "payment_confirm_receipt"=> $this->input->post('payment_confirm_receipt') ? $this->input->post('payment_confirm_receipt') : null
        ];
        if ($this->input->post('submit')) {
          $this->load->helper("common");
          $this->load->helper("qrcode");
          $this->load->model("modelcoupons");
    
          $shipper_id = $this->input->post('shipper_id');
          $total_price = $this->input->post('total_price');
          $payment_confirm_receipt = $this->input->post('payment_confirm_receipt');

          // Create/Update Coupon
          $rowShipper = $this->modelshippers->getDetailshippers($shipper_id);
          if ($rowShipper) {
            $shipper_price = $rowShipper->shipper_price;
            $total_price = $coupon_price + $shipper_price;
            $rowCoupon = $this->modelcoupons->getDetailcouponByregistrationandedition($registration_id, $edition_id);
            $coupon_id = 0;
            if ($rowCoupon) {
              $coupon_id = $rowCoupon->idx;
              date_default_timezone_set('Asia/Jakarta');
              $data_update = [
                'edition_id'=>$edition_id,
                'coupon_number'=>$coupon_number,
                'coupon_price'=>$coupon_price,
                'shipper_price'=>$shipper_price,
                'total_price'=>$total_price,
                'payment_status_id'=>'1',
                'registration_id'=>$registration_id,
                'shipper_id'=>$shipper_id,
                'payment_confirm_receipt'=>$payment_confirm_receipt,
                'updated_at'=>date('Y-m-d H:i:s'),
              ];
              $this->modelcoupons->setUpdatecouponsbatch($coupon_id, $data_update);
            } else {
              //generate qr code
              $prefix = "COP-ED".$edition_id."_"."RG".$registration_id;
              $xqr_code = generate_qrcode($prefix);
              $data_insert = [
                'edition_id'=>$edition_id,
                'coupon_number'=>$coupon_number,
                'qr_code'=>$xqr_code,
                'coupon_price'=>$coupon_price,
                'shipper_price'=>$shipper_price,
                'total_price'=>$total_price,
                'payment_status_id'=>'1',
                'registration_id'=>$registration_id,
                'shipper_id'=>$shipper_id,
                'payment_confirm_receipt'=>$payment_confirm_receipt,
              ];
              $coupon_id = $this->modelcoupons->setInsertcouponsbatch($data_insert);
            }
          }
    
          // If coupon creation success
          if ($coupon_id != 0) {
            redirect(base_url() . "frontend/couponpurchase/confirm");
          } else {
            $message = "Create Coupon Failed";
          }
        }
        $data = ['message' => $message, 'formdata' => $formdata];
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

    function confirm() {
      $this->load->model("modelfrontend");
      $dataHeader = $this->modelfrontend->getDataHeader();
      $this->load->view('viewfrontend/layout/header', $dataHeader);
      $this->load->view('viewfrontend/layout/leftmenu', ['showback' => true, 'showmainmenu' => false, 'showadditionalmenu' => false]);
      $this->load->view('viewfrontend/couponpurchaseconfirm' );
      $this->load->view('viewfrontend/layout/rightmenu', ['showmainmenu' => false]);
      $this->load->view('viewfrontend/layout/footer', ['ajaxfilename'=> '']);
    }
  
}