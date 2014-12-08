<?php
/**
 * Description of AdminController
 * @author Aizerla
 */
namespace Admin\Controller;

use Think\Controller;
use Think\Auth;

class DbController extends AdminController
{

    public function index()
    {
        $this->display();
    }

    public function import()
    {
        if (IS_POST) {
            if (isset($_FILES['db']) && !$_FILES['db']['error'] && $_FILES['db']['tmp_name']) {
                dump(file_get_contents($_FILES['db']['tmp_name']));
            }
        }
    }
}
