<?php
class Receptionists extends Controller
{
    public  function Index()
    {
        $data = [];

        $this->view('Receptionist/index');
    }
   
}
