<?php

class Pages extends Controller
{
    public function __construct()
    {
    }
    public function index()
    {
        $data = [
            'title' => 'Welcome',
        ];
        $this->view('pages/index', $data);
    }
    public function about()
    {
        $data = ['title' => 'This is about page'];
        $this->view('pages/about', $data);
    }
}
