<?php
class Homes extends Controller
{
    public $customerModel;

    public function __construct()
    {
    
    }

    public function home()
    {
        $data = [];

        $this->view('home/index');
    }
}
