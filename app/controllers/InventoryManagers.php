 <?php
class InventoryManagers extends Controller
{
    public  function Index()
    {
        $data = [];

        $this->view('InventoryManager/index');
    }

}
