<?php
/**
 * Description of IndexController
 * @author Aizerla
 */
namespace Admin\Controller;
class IndexController extends AdminController
{

    public function index()
    {
        $crypt = new \Think\Crypt();
        /*echo $crypt->decrypt(cookie('user'), C('DATA_AUTH_KEY'));
        echo session('username');*/
        $this->display();
    }


    public function password()
    {
        if (IS_POST) {
            if (check_verify(I('post.verify'), 1)) {

                /** @var \Admin\Model\BeUserModel $beUser */
                $beUser = D('BeUser');
                $result = $beUser->where('id=' . session(C('USER_AUTH_KEY')) . ' AND password="' . sys_md5(I('post.password')) . '"')->find();
                if (!is_null($result)) {
                    if (trim(I('post.new-password')) != '' && I('post.new-password') == I('post.re-password')) {
                        $password = array('password' => sys_md5(I('post.new-password')));
                        $beUser->where('id=' . session(C('USER_AUTH_KEY')))->data($password)->save();
                        $this->view->assign('class', 'success');
                        $this->view->assign('message', '密码已更新');
                    } else {
                        $this->view->assign('class', 'danger');
                        $this->view->assign('message', '新密码与确认密码一样！请重试……');
                    }
                } else {
                    $this->view->assign('class', 'danger');
                    $this->view->assign('message', '原密码错误');
                }
            } else {
                $this->view->assign('class', 'danger');
                $this->view->assign('message', '验证码错误');
            }
        }
        $this->display();
    }

    /**
     *
     */
    public function profile()
    {
        if (IS_POST) {
            if (check_verify(I('post.verify'), 1)) {
                /** @var \Admin\Model\BeUserModel $beUser */
                $beUser = D('BeUser');
                if ($beUser->create()) {
                    $beUser->save();
                    $this->view->assign('class', 'success');
                    $this->view->assign('message', '修改成功');
                } else {
                    $this->view->assign('class', 'danger');
                    $this->view->assign('message', '出错了，请重试……');
                }
            } else {
                $this->view->assign('class', 'danger');
                $this->view->assign('message', '验证码错误');
            }
        }
        $beUserModel = M('BeUser');
        $user = $beUserModel->getById(session(C('USER_AUTH_KEY')));
        $this->assign('user', $user);
        $this->display();
    }

    /**
     *
     */
    public function check()
    {
        $beUser = D('BeUser');
        $res = $beUser->checkFiledOne(I('post.'));
        if (!$res['res']) {
            $data = array('error' => L($res['vfiled']) . '已被占用！');
            $this->ajaxReturn($data);
        }
    }
}