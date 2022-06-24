<?php
require_once('mvc/core/Controller.php');
require_once('mvc/helpers/session_helper.php');
require_once('config.php');

class PageController extends Controller
{

    public function login()
    {
        // if (isset($_SESSION['usersId'])) {
        //     popupSuccess('modal_success', 'Bạn đã đăng nhập rồi');
        //     redirect('/admin/dashboad');
        // } else {
        //     $data = ['login'];
        //     $this->render('pages/login', $data);
        // }
        $data = ['login'];
        $this->render('pages/login', $data);
    }
}
