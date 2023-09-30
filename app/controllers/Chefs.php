<?php
class Chefs extends Controller
{
    public  function Index()
    {
        $data = [];

        $this->view('chef/index');
    }
   
}
