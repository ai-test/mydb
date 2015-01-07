<?php
/**
 * Description of AdminController
 * @author Aizerla
 */
namespace Admin\Controller;

use Think\Controller;
use Think\Auth;

class JournalistController extends AdminController
{

    public function index()
    {
        $this->display();
    }

    public function add()
    {
        if (IS_POST) {
            $data = array(
                'name' => I('post.name'),
                'jouna_code' => I('post.jouna_code'),
                'id_number' => I('post.id_number'),
                'company' => I('post.company'),
                'content' => I('post.content'),
            );

            if (check_verify(I('post.verify'), 1)) {

                /** @var \Admin\Model\JournalistModel $journalist */
                $journalist = D('Journalist');
                $journalist->create($data);
                $journalist->add();

                $this->view->assign('class', 'success');
                $this->view->assign('message', '添加成功');
            } else {
                $this->view->assign('class', 'danger');
                $this->view->assign('message', '验证码错误');
            }
        }

        $this->display('index');
    }
}
