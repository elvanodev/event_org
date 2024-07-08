<?PHP

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


/**
 * NOTHING ELSE TO EDIT BELOW THIS LINE.
 */
require 'whatsapp/whatsprot.class.php';

class Whatsapp extends WhatsProt {

    function __construct($config = array()) {
        // Your own constructor code
        $this->initialize($config);
    }

    public function initialize($config = array()) {
        $config['webpassword'] = 'MakeUpPassword';


        $config['YOURNAME'] = [
            'fromNumber' => '628562908577',
            'nick' => 'YOURNICKNAME',
            'waPassword' => 'EsdfsawS+/ffdskjsdhwebdgxbs=',
            'email' => 'testemail@gmail.com',
            'emailPassword' => 'gmailpassword',
        ];
    }

    public function sendwa() {
        $username = "628562908577"; // no hp yang kita registrasikan
        $nickname = "Brad Pitt"; // sebaiknya nama kamu supaya penerima pesan mengenali anda
        $token = 'PdA2DJyKoUrwLw1Bg6EIhzh502dF9noR9uFCllGk{phone}';
        $debug = true; // Shows debug log, this is set to false if not specified
        $log = true; // Enables log file, this is set to false if not specified
        $password = "e2BYNTBHSmp2WZJ8hGY6QhpNtxxxx"; // password yang kita dapatkan dari tool yang sudah dibahas di poin 1a,1b,1c

        $w = new WhatsProt($username, $token, $nickname, $debug);
        $w->connect(); // Connect to WhatsApp network
        $w->loginWithPassword($password); // logging in with the password we got!

        $agus = '628562908577'; // Nomor tujuan kita, biasanya nomor teman
        $message = 'testing bro, dari web nih, kalau diterima tolong reply';

//        $w->sendPresenceSubscription($agus);
        $w->sendMessage($agus, $message);

        $w->disconnect();
    }

    public function getid() {
        require_once 'whatsapp/Registration.php';
        $number = "628562908577";  // tanpa tanda []
        $nick = "wawan";
        $username = $number;
        $token = 'PdA2DJyKoUrwLw1Bg6EIhzh502dF9noR9uFCllGk{phone}';
        $nickname = $nick;
        $debug = true;
        $w = new Registration($username, $debug);
//        try {
//            $result = array();
//        } catch (Exception $w) {
        $result = $w->codeRequest('sms');
//        }
//        echo $result->id;
    }

    public function getpassword() {
        require_once 'whatsapp/Registration.php';
        $number = "628562908577";  // tanpa tanda []
        $nick = "wawan";
        $codeReg = "234611";
        $username = $number;
        $token = md5($username);
        $nickname = $nick;
        $debug = true;
        $w = new Registration($username, $debug);
        $result = $w->codeRegister($codeReg);
        $password = $result->pw;
        echo $password;
    }

}
?>