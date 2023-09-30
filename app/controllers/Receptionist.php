<?php
class Receptionist extends Controller
{
    public  function Index()
    {
        $data = [];

        $this->view('Receptionist/index');
    }
   
}
