<?php
class Customers extends Controller
{
    public  function Index()
    {
        $data = [];

        $this->view('customer/index');
    }
    public  function Home()
    {
        $data = [];

        $this->view('customer/home');
    }
}
