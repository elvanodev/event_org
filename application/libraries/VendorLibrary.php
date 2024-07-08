<?php
use Vendor\Midtrans;
class MidtransLibrary{
    public $class;
    public function __constuct()
    {
        log_message('Debug', 'Midtrans class is loaded.');
        // $this->class = new Midtrans();
    }
    public function clear($data)
    {
        return $this->class->clean($data);
    }
}