<?php
class Homes extends Controller
{
    public $homeModel;

    public function __construct()
    {
        $this->homeModel = $this->model('Home');

    }

    public function home()
    {   
        $menus = $this->homeModel->getMenus();

        if ($food = $this->homeModel->getFoodReviews()) {
        } else {
            die('Something went wrong');
        }


        $data = [
            'menus' => $menus,
            'foodReview' => $food
        ];


        $this->view('home/index' , $data);
    }
}
