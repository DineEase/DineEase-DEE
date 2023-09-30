<?php
class Manager extends Controller
{
    public  function Index()
    {
        $data = [];

        $this->view('manager/index');
    }
   
}
