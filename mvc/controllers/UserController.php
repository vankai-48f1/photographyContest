<?php

require_once('config.php');
require_once('mvc/core/Controller.php');
require_once('mvc/models/user.php');
require_once('mvc/helpers/session_helper.php');
require_once('mvc/models/photography.php');

class UserController extends Controller
{

    private $userModel;

    public function __construct()
    {
        $this->userModel = new User;
    }

    public function login()
    {

        //Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        // var_dump($_POST);die;
        //Init data
        $data = [
            'email' => trim($_POST['email']),
            'password' => trim($_POST['password'])
        ];

        if (empty($data['email']) || empty($data['password'])) {

            flash("login", "Please enter email and password information");

            $this->render('pages/login', ['login']);
            exit();
        }
        
        //Check for user/password
        if ($this->userModel->findUserByEmail($data['email'])) {
            
            //User Found
            $loggedInUser = $this->userModel->login($data['email'], $data['password']);

            if ($loggedInUser) {
                //Create session
                $this->createUserSession($loggedInUser);
            } else {
                flash("login", "Wrong password");
                $this->render('pages/login', ['login']);
            }
        } else {
            flash("login", "This account could not be found");
            redirect("login");
        }
    }

    public function createUserSession($user)
    {
        $_SESSION['usersId'] = $user->id;
        $_SESSION['usersName'] = $user->username;
        $_SESSION['usersEmail'] = $user->email;

        if ($this->isAdmin()) {
            redirect("/admin/dashboard");
        } else {
            popupSuccess("modal_success", "Logged in successfully.");
            redirect("/");
        }
    }

    public function logout()
    {
        unset($_SESSION['usersId']);
        unset($_SESSION['usersName']);
        unset($_SESSION['usersEmail']);
        unset($_SESSION['login']);
        unset($_SESSION['cantLoginAgain']);
        session_unset();
        session_destroy();
        redirect(ROUTE_PAGES_LOGIN_CONTROLLER);
    }

    public function store()
    {
        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING); // filter and validate mutiple value request

        $data = [
            'username'         => trim($_POST['username']),
            'email'            => trim($_POST['email']),
            'password'         => trim($_POST['password'])
        ];
        // var_dump(empty($data['username']));die;
        // Validate inputs
        if (empty($data['username']) || empty($data['email']) || empty($data['password'])) {
            flash("login", "Please fill out all inputs", "", "message-error mt-5");
            redirect(ROUTE_PAGES_LOGIN_CONTROLLER);
        }
        
        // Validate repeat password
        if ($data['password'] != trim($_POST['repeat_password'])) {
            flash("login", "Repeat incorrect password.", "", "message-error mt-5");
            redirect(ROUTE_PAGES_LOGIN_CONTROLLER);
        }
        // var_dump($data);die;

        if ($this->userModel->checkUserExist($data['email'])) {
            flash("login", "Email already exists!", "", "message-error mt-5");
            redirect(ROUTE_PAGES_LOGIN_CONTROLLER);
        }

        if ($this->userModel->addInformation($data)) {
            popupSuccess("modal_success", "Successful account creation.");
            redirect("/");
        } else {
            flash("login", "ERROR", "", "message-error mt-5");
            redirect(ROUTE_PAGES_LOGIN_CONTROLLER);
        }
    }

    public function vote($id)
    {
        if (!$this->issetUser()) {
            flash("login", "Bạn phải đăng nhập trước khi vote.", "", "message-error mt-5");
            redirect(ROUTE_PAGES_LOGIN_CONTROLLER);
        }
        
        $user = $this->userSession();

        $data = array(
            'user_id' => $user->id,
            'photography_id' => (int)$id
        );
        
        
        if ($this->userModel->submission($data)) {
            $photography = new Photography();
            $photographyItem = $photography->getItemPhotography($id);
            popupSuccess("modal_success", "Bạn đã bình chọn cho $photographyItem->name thành công.");
            redirect("/");
        } else {
            popupSuccess("modal_success", "Chỉ được bình chọn một lần.", ' text-white bg-danger');
            redirect("/");
        }
    }
}
