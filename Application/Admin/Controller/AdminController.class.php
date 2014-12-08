<?php
/**
 * Description of AdminController
 * @author Aizerla
 */
namespace Admin\Controller;

use Think\Controller;
use Think\Auth;

class AdminController extends Controller
{

    protected $user = null;

    /**
     * initialize listener
     */
    protected function _initialize()
    {
        // check login user
        if (!session('?' . C('USER_AUTH_KEY'))) {
            $this->redirect('Public/login');
        }
        // is admin ?
        $this->user = session(PublicController::BE_SESSION_NAME);
        if ($this->user == C('ADMIN_AUTH_KEY')) {
            return true;
        }

        // check auth permission
        $auth = new Auth();
        $module_name = CONTROLLER_NAME . '/' . ACTION_NAME;
        if (!$auth->check($module_name, session(C('USER_AUTH_KEY')))) {
            $this->error(L('_VALID_ACCESS_'));
        }
    }

    /**
     *
     */
    public function index()
    {
        $this->display();
    }

    /*public function add()
    {
        if (IS_POST) {
            $name = D(CONTROLLER_NAME);
            if ($name->create()) {

            } else {
                $this->error($name->getError());
            }
        } else {
            $this->display('edit');
        }
    }*/
}
