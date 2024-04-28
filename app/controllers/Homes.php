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

    public function getReservationSlots()
    {
        $date = $_GET['date'] ?? null;

        if (!$date) {
            http_response_code(400);
            echo json_encode(['error' => 'No date provided']);
            return;
        }

        $slots = $this->homeModel->getSlots($date);
        header('Content-Type: application/json');
        echo json_encode($slots);
    }

}
