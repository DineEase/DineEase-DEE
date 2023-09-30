 <?php
class InventoryManager extends Controller
{
    public  function Index()
    {
        $data = [];

        $this->view('InventoryManager/index');
    }

}
