<?php

class ctrfileupload extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
		$this->load->model('basemodel');
    }

    public function index() {
        $this->load->view('upload');
    }

    public function upload_file() {
        $status = "";
        $msg = "";

//   $xnamacalon = $_POST['edNamaLengkap'];
//   $photoname = $_POST['photoname'];
        $userfile = $_POST['userfile'];
        //echo "blaa" . $userfile;
        $file_element_name = $userfile;
//   if (empty($_POST['title']))
//   {
//      $status = "error";
//      $msg = "Please enter a title";
//   }
        //$config['upload_path'] =  './files/';
        $config['upload_path'] = './resource/uploaded/img/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = 10000000;
        $config['encrypt_name'] = false;
        $this->load->library('upload', $config);
        /*   if (!$this->upload->do_upload($file_element_name))
          {
          $status = 'error';
          $msg = $this->upload->display_errors('', '');
          }
          else
          {
          $data = $this->upload->data();
          //$file_id = $this->files_model->insert_file($data['file_name'], $_POST['title']);

          if($file_id)
          {
          $status = "success";
          $msg = "File successfully uploaded";
          }
          else
          {
          unlink($data['full_path']);
          $status = "error";
          $msg = "Something went wrong when saving the file, please try again.";
          }
          }
          @unlink($_FILES[$file_element_name]);
          } */
        if (!$this->upload->do_upload($file_element_name)) {
            //$error = array('error' => $this->upload->display_errors());
            //$this->load->view('upload_form', $error);
            echo "erorrr";
        } else {
            //$data = array('upload_data' => $this->upload->data());
            //$this->load->view('upload_success', $data);
            $res = $this->upload->data();

            $file_path = $res['file_path'];
            $file = $res['full_path'];
            $file_ext = $res['file_ext'];
            //$xNamfile = str_replace(' ','_',$xnamacalon);
            //$final_file_name = $xNamfile.$file_ext;
            // here is the renaming functon
            //rename($file, );
        }
        $this->load->helper('json');
        $this->json_data['file'] = $data['file_name'];
        echo json_encode($this->json_data);
        //echo json_encode(array('status' => $status, 'msg' => $msg));
    }

    public function upload() {


// A list of permitted file extensions
        $allowed = array('png', 'jpg', 'jpeg');
        $allowedimg = array('png', 'jpg', 'jpeg');

        if (isset($_FILES['upl']) && $_FILES['upl']['error'] == 0) {

            $extension = pathinfo($_FILES['upl']['name'], PATHINFO_EXTENSION);

//	if(!in_array(strtolower($extension), $allowed)){
//		echo '{"status":"error"}';
//		exit;
//	}

            if (move_uploaded_file($_FILES['upl']['tmp_name'], './resource/uploaded/img/' . $_FILES['upl']['name'])) {
//                echo in_array(strtolower($extension), $allowed);
                if (in_array(strtolower($extension), $allowedimg)) {
                    $this->load->model('basemodel');
                    $resize = $this->basemodel->imageresize(200, 200, $_FILES['upl']['name']);
//                    echo $resize;
//                    die();
                }
                echo '{"status":"success"}';
                exit;
            }
        }

        echo '{"status":"error"}';
        exit;
    }

}

?>