<?php
class Menus extends Controller{
    public $menuModel;
    public function __construct()
    {
        $this->menuModel = $this->model('Menu');
    }
    public function submitMenu(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'ID' => isset($_POST['ID']) ? trim($_POST['ID']) : '',
                'name' =>  isset($_POST['name']) ? trim($_POST['name']) : '',
                'price' =>  isset($_POST['price']) ? trim($_POST['price']) : '',
                'description' =>  isset($_POST['description']) ? trim($_POST['description']) : '',
                'ID_err' => '',
                'name_err' => '',
                'price_err' => '',
                'description_err' => ''
            ];
            if (empty($data['ID'])){
                $data['ID_err'] = 'Please enter ID';
            }else{
                if ($this->menuModel->findMenuByID($data['ID'])){
                    $data['ID_err'] = 'ID is already taken';
                }
            }
            if (empty($data['name'])){
                $data['name_err'] = 'Please enter name';
        }else{
            if ($this->menuModel->findMenuByName($data['name'])){
                $data['name_err'] = 'name is already taken';
            }
        }
        if (empty($data['price'])){
            $data['price_err'] = 'Please enter price';
        }
        if (empty($data['description'])){
            $data['description_err'] = 'Please enter description';
        }
        if (empty($data['ID_err']) && empty($data['name_err']) && empty($data['price_err']) && empty($data['description_err'])){
            if ($this->menuModel->submitMenu($data)){
                //header('location: ' . URLROOT . '/menus/submitMenu');
            }else{
                die('Something went wrong');
            }
    }

}
}
public function editMenuimage(){
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $data = [
            'id' => isset($_POST['id']) ? trim($_POST['id']) : '',
            'image' =>  isset($_POST['image']) ? trim($_POST['image']) : '',
            'id_err' => '',
            'image_err' => ''
        ];
        if (empty($data['id'])){
            $data['id_err'] = 'Please enter id';
        }else{
            if ($this->menuModel->findMenuByID($data['id'])){
                $data['id_err'] = 'id is already taken';
            }
        }
        if (empty($data['image'])){
            $data['image_err'] = 'Please enter image';
        }
        if (empty($data['id_err']) && empty($data['image_err'])){
            if ($this->menuModel->editMenuimage($data)){
                //header('location: ' . URLROOT . '/menus/editMenuimage');
            }else{
                die('Something went wrong');
            }
    }

}
}
public function editMenu(){
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $data = [
            'id' => isset($_POST['id']) ? trim($_POST['id']) : '',
            'name' =>  isset($_POST['name']) ? trim($_POST['name']) : '',
            'price' =>  isset($_POST['price']) ? trim($_POST['price']) : '',
            'description' =>  isset($_POST['description']) ? trim($_POST['description']) : '',
            'id_err' => '',
            'name_err' => '',
            'price_err' => '',
            'description_err' => ''
        ];
        if (empty($data['id'])){
            $data['id_err'] = 'Please enter id';
        }else{
            if ($this->menuModel->findMenuByID($data['id'])){
                $data['id_err'] = 'id is already taken';
            }
        }
        if (empty($data['name'])){
            $data['name_err'] = 'Please enter name';
    }else{
        if ($this->menuModel->findMenuByName($data['name'])){
            $data['name_err'] = 'name is already taken';
        }
    }
    if (empty($data['price'])){
        $data['price_err'] = 'Please enter price';
    }
    if (empty($data['description'])){
        $data['description_err'] = 'Please enter description';
    }
    if (empty($data['id_err']) && empty($data['name_err']) && empty($data['price_err']) && empty($data['description_err'])){
        if ($this->menuModel->editMenu($data)){
            //header('location: ' . URLROOT . '/menus/editMenu');
        }else{
            die('Something went wrong');
        }
}

}
}
public function hideMenu(){
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $data = [
            'id' => isset($_POST['id']) ? trim($_POST['id']) : '',
            'id_err' => ''
        ];
        if (empty($data['id'])){
            $data['id_err'] = 'Please enter id';
        }else{
            if ($this->menuModel->findMenuByID($data['id'])){
                $data['id_err'] = 'id is already taken';
            }
        }
        if (empty($data['id_err'])){
            if ($this->menuModel->hideMenu($data['id'])){
                //header('location: ' . URLROOT . '/menus/hideMenu');
            }else{
                die('Something went wrong');
            }
    }

}
}


