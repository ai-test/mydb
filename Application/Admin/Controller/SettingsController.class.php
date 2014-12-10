<?php
/**
 * Description of AdminController
 * @author Aizerla
 */
namespace Admin\Controller;

use Think\Controller;
use Think\Auth;

class SettingsController extends AdminController
{

    public function index()
    {
        $settings = array(
            'km_1' => C('km_1'),
            'km_2' => C('km_2'),
            'km_3' => C('km_3'),
            'km_4' => C('km_4'),
            'km_5' => C('km_5'),
            'km_6' => C('km_6'),
            'km_7' => C('km_7'),
            'km_8' => C('km_8'),
            'km_9' => C('km_9'),
            'km_10' => C('km_10'),
        );
        $this->assign('settings', $settings);
        $this->display();
    }

    public function save()
    {
        if (IS_POST) {

            $settings = array(
                'km_1' => I('post.km_1'),
                'km_2' => I('post.km_2'),
                'km_3' => I('post.km_3'),
                'km_4' => I('post.km_4'),
                'km_5' => I('post.km_5'),
                'km_6' => I('post.km_6'),
                'km_7' => I('post.km_7'),
                'km_8' => I('post.km_8'),
                'km_9' => I('post.km_9'),
                'km_10' => I('post.km_10'),
            );
            $settingsFile = CONF_PATH . 'settings.php';
            if (is_file($settingsFile)) {
                unlink($settingsFile);
            }
            if (!is_file($settingsFile)) {
                file_put_contents($settingsFile,"<?php\nreturn ". var_export($settings, true) . ";");
            }
            $this->redirect('Settings/index');
        }
    }
}
