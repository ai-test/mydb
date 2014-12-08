<?php
/**
 * Description of PublicController
 * @author Aizerla
 */
namespace Admin\Controller;

use Think\Controller;

class PublicController extends Controller
{

    protected $_cookie = 'be_user';

    const BE_SESSION_NAME = 'be_user';

    protected $_suffixUsername = 'ai_username';

    protected $_suffixPassword = 'ai_password';

    /**
     * Public
     * login action
     */
    public function login()
    {
        if (IS_AJAX) {
            if (check_verify(I('post.verify'), 1)) {
                $beUser = M('BeUser');
                $isEmail = $beUser->regex(I('post.username'), 'email');
                $loginUser = null;

                if ($isEmail) {
                    $loginUser = $beUser->where('email=\'' . I('post.username') . '\'')->find();
                } else {
                    $loginUser = $beUser->where('username=\'' . I('post.username') . '\'')->find();
                }
                if (!is_null($loginUser) && sys_md5(I('post.password')) == $loginUser['password']) {
                    if (!$loginUser['status']) {
                        $this->error(L('USER_STOP'));
                    }
                    $upgrade = array(
                        'login_ip' => get_client_ip(),
                        'last_login_time' => time()
                    );
                    $logUser = $beUser->where(array('id' => $loginUser['id']))->save($upgrade);
                    if ($logUser) {
                        $beUser->where(array('id' => $loginUser['id']))->setInc('login_count');
                    }
                    if (I('post.keep') == 'on') {
                        $crypt = new \Think\Crypt();
                        $theInfo = array(
                            'username' => $crypt->encrypt($loginUser['username'], sys_md5(C('DATA_AUTH_KEY'), $this->_suffixUsername), 3600 * 24 * 15),
                            'password' => $crypt->encrypt($loginUser['password'], sys_md5(C('DATA_AUTH_KEY'), $this->_suffixPassword), 3600 * 24 * 15)
                        );
                        $theReturn = $crypt->encrypt(json_encode($theInfo), C('DATA_AUTH_KEY') . $_SERVER["HTTP_USER_AGENT"]);
                        cookie($this->_cookie, $theReturn, 3600 * 24 * 15);
                    }
                    session(C('USER_AUTH_KEY'), $loginUser['id']);
                    session(self::BE_SESSION_NAME, $loginUser['username']);
                    $this->success(L('LOGIN_SUCCESS'), U('Index/index'));
                } else {
                    $this->error(L('LOGIN_ERROR'));
                }
            } else {
                $this->error(L('VERIFY_ERROR'));
            }
        } else {
            if (session(C('USER_AUTH_KEY'))) {
                $this->redirect('Index/index');
            } elseif (cookie($this->_cookie)) {
                $crypt = new \Think\Crypt();
                $theReturn = $crypt->decrypt(cookie($this->_cookie), C('DATA_AUTH_KEY') . $_SERVER["HTTP_USER_AGENT"]);
                $theKeepUser = json_decode($theReturn, true);
                foreach ($theKeepUser as $key => $value) {
                    if ($key == 'username') $username = $crypt->decrypt($value, sys_md5(C('DATA_AUTH_KEY'), $this->_suffixUsername));
                    if ($key == 'password') $pwd = $crypt->decrypt($value, sys_md5(C('DATA_AUTH_KEY'), $this->_suffixPassword));
                }
                $beUser = M('BeUser');
                $theUser = $beUser->where('username=\'' . $username . '\'')->find();
                if ($theUser && $theUser['password'] == $pwd) {
                    session(C('USER_AUTH_KEY'), $theUser['id']);
                    session(self::BE_SESSION_NAME, $theUser['username']);
                    $this->redirect('Index/index');
                } else {
                    cookie(null);
                    $this->display();
                }
            } else {
                $this->display();
            }
        }
    }

    /**
     * Generator
     * verify captcha
     */
    public function verify()
    {
        $config = array(
            'fontSize' => 13,
            'useCurve' => false,
            'useNoise' => true,
            'length' => 4,
            'fontttf' => '6.ttf',
            'imageH' => 27
        );
        $verify = new \Think\Verify($config);
        $verify->entry(1);
    }

    /**
     * Public
     * logout action
     */
    public function logout()
    {
        if (session(C('USER_AUTH_KEY'))) {
            cookie(NULL);
            session('[destroy]');
            $this->redirect('Public/login');
        } else {
            $this->error(L('ALREADY_OUT'));
        }
    }
}
