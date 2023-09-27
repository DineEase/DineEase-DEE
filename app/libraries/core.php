<?php
/*
        *app core class
        *creates url and loads core controller
        *url format - /controller/method/params
    */
class Core
{
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct()
    {
        // print_r($this->getUrl());
        $url = $this->getUrl();

        // THERE IS A PROBLEM HERE WITH THE URL ARRAY BEING EMPTY AND THE CODE BELOW NOT WORKING AS EXPECTED
        // LOOK AT THE URL ARRAY AND SEE IF YOU CAN FIGURE OUT WHY IT IS EMPTY

        //fixed by adding isset to the if statement

        //look in controllers for first value

        if (isset($url[0])) {
            if (file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) { //ucwords capitalize the first letter
                //set as current controller
                $this->currentController = ucwords($url[0]);
                //unset 0 index
                unset($url[0]);
            }
        }
        //require the controller
        require_once '../app/controllers/' . $this->currentController . '.php';

        //instantiate controller class
        $this->currentController = new $this->currentController();

        //check for second part of url
        if (isset($url[1])) {
            //check to see if method exists in controller
            if (method_exists($this->currentController, $url[1])) {
                $this->currentMethod = $url[1];
                //unset 1 index
                unset($url[1]);
            }
        }
        //get params
        $this->params = $url ? array_values($url) : [];

        //call a callback with array of params
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }
    public function getUrl()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/'); //trim the / from the end of the url

            $url = filter_var($url, FILTER_SANITIZE_URL); //filter the url

            $url = explode('/', $url); //explode the url into an array
            return $url;
        }
    }
}
