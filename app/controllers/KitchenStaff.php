<?php
class KitchenStaff extends Controller
{
    public  function Index()
    {
        $data = [];

        $this->view('kitchenStaff/index');
    }
   
}
