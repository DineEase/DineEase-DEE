<?php
class Managers extends Controller
{
    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        } else {
            if (isset($_SESSION['user_id'])) {
                if ($_SESSION['role'] != 'manager') {
                    destroyOldSession();
                }
            }
        }
    }
    public  function Index()
    {
        $data = [];

        $this->view('manager/index');
    }
}
