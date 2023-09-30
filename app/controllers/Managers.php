<?php
class Managers extends Controller
{
    public  function Index()
    {
        $data = [];

        $this->view('manager/index');
    }
   
}
