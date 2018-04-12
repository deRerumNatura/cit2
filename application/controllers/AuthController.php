<?php

namespace application\controllers;
use application\core\Controller;
use application\models\Users;
use application\models\Countries;

class AuthController extends Controller
{
    public $login;
    public $password;
    public $email;
    public $errors = [];
        
    public function __construct($route, array $url_params = [], array $post_vars = [])
    {
        parent::__construct($route, $url_params, $post_vars);

    }

    public function index()
    {
        $this->view->render('Welcome CodeIT');
    }

    public function showSingIn() 
    {
        $this->view->render('Sing in');
    }

    public function showSingUp()
    {
        $country = new Countries;
        $countries = [];

        foreach($country->get() as $country){
            $countries[] = $country['country_name'];
        }
       
        $this->view->render('Sing up',['countries' => $countries]);
    }

    public function login()
    {   

    $loginData = $this->getLoginData($_POST);
         
       if ( $loginData ) {
            $validateLogin = $this->validateLoginData();
            
            if( $validateLogin ) {
                $userExist = $this->checkUserExist();
               
                if( $userExist ) {

                    $users = new Users;
//                    dump($this->email);
                    $loginByEmail = $users->getEmailUser($this->email);
//                    dd($loginByEmail);
                    $_SESSION['login'] = ( !empty($this->login) ) ? $this->login : $loginByEmail['login'];
                    header("location: ".FULL_PATH."/admin");
                }
            }
            
        }
        if(!empty($this->errors)) {
            $this->view->render('Error login', ['log_errors' => $this->errors,]);
        }

        
    }

    public function logout()
    {
        unset($_SESSION['login']);
        header("location: ".FULL_PATH."/");
    }

    public function register()
    {
        $registerData = $this->getRegisterData($_POST);

        if ( $registerData ) {

            $userExist = $this->checkUserExist($registerData);
          
            if( !$userExist ) {

                $validateRegistration = $this->validateRegisterData($registerData);
           
                if( $validateRegistration ) {

                    $this->addUser($registerData);
                    
                    $_SESSION['login'] = $registerData['login'];

                    foreach($_SESSION as $key => $value) {
                        if($key == 'login') {
                            continue;
                        }
                        unset($_SESSION[$key]);
                    }

                    header("location: ".FULL_PATH."/admin");
                }
            }

        }

        if(!empty($this->errors)) {
            $country = new Countries;
            $countries = [];

            foreach($country->get() as $country){
                $countries[] = $country['country_name'];
            }

            $this->view->render('Error register', [
                'reg_errors' => $this->errors,
                'countries' => $countries,
                ]
            );
        }
    }

    private function addUser($registerData) 
    {

        $users = new Users;
        $columns = [];
        $values = [];
        
        foreach($registerData as $column => $value) {
            if ( $column == 'password' ) {
                $values[] = md5(md5(trim($value)));
                $columns[] = $column;
                continue;
            }

            if ( $column == 'checkbox' ) {
                continue;
            }
            $columns[] = $column;
            $values[] = $value;
        }
        $columns[] = 'created_at';
        $values[] = date('Y-m-d H:i:s');

        return $users->addUser($columns, $values);
    }

    private function validateLoginData () 
    {
        if($this->login == NULL) {
            if(!preg_match('/^((([0-9A-Za-z]{1}[-0-9A-z\.]{1,}[0-9A-Za-z]{1})|([0-9А-Яа-я]{1}[-0-9А-я\.]{1,}[0-9А-Яа-я]{1}))@([-A-Za-z]{1,}\.){1,2}[-A-Za-z]{2,})$/u', $this->email)) {
                $this->errors[] = "Please enter a valid email";
            }
        }
        else {
            if(!preg_match("/^[a-zA-Z0-9]+$/", $this->login)) {
                $this->errors[] = "The login can consist only of letters of the English alphabet and numbers";
            }

            if(strlen($this->login) < 3 or strlen($this->login) > 30) {
                $this->errors[] = "Login must be at least 3 characters and not more than 30";
            }
        }

        if(!preg_match("/^[a-zA-Z0-9]+$/",$this->password)) {
            $this->errors[] = "Login must be at least 3 characters and not more than 30";
        }

        if(strlen($this->password) < 3 or strlen($this->password) > 30) {
            $this->errors[] = "Password must be at least 3 characters and not more than 30";
        }

        if(!empty($this->errors)) {
            return false;
        }

        return true;
    }

    private function validateRegisterData($registerData) 
    {
        
        // dd($registerData); 
        if(!preg_match("/^[a-zA-Z0-9]+$/",$registerData['login'])) {
            $this->errors[] = "The login can consist only of letters of the English alphabet and numbers";
        }
        if(!preg_match("/^[a-zA-Z0-9]+$/",$registerData['password'])) {
            $this->errors[] = "The password can consist only of letters of the English alphabet and numbers";
        }
        // ================EMAIL============================
        if(!preg_match('/^((([0-9A-Za-z]{1}[-0-9A-z\.]{1,}[0-9A-Za-z]{1})|([0-9А-Яа-я]{1}[-0-9А-я\.]{1,}[0-9А-Яа-я]{1}))@([-A-Za-z]{1,}\.){1,2}[-A-Za-z]{2,})$/u', $registerData['email'])) {
            $this->errors[] = "Please enter a valid email";
        }
        // ================NAME============================
        if(!preg_match("/^[a-zA-Z]+$/",$registerData['name'])) {
            $this->errors[] = "The name can consist only of letters of the English alphabet";
        }
        if(strlen($registerData['name']) < 2 or strlen($registerData['name']) > 30) {
            $this->errors[] = "The name must be at least 3 characters and not more than 30 characters.";
        }
        // =====================DATE=========================
        if(!preg_match('/\d{4}-\d{2}-\d{2}/',$registerData['b_date'])) {
            $this->errors[] = "Enter the correct date";
        }
        if(strlen($registerData['login']) < 3 or strlen($registerData['login']) > 30) {
            $this->errors[] = "Login must be at least 3 characters and not more than 30";
        }
        if(strlen($registerData['password']) < 3 or strlen($registerData['password']) > 30) {
            $this->errors[] = "Password must be at least 3 characters and not more than 30";
        }
        if(!empty($this->errors)) {
            return false;
        }
        return true;
    }

    private function getRegisterData($post) 
    {
        $checkIsset = true;
//        dd(isset($post['checkbox']));
        foreach($post as $key =>  $value) {

            if(empty($post[$key]) && $key == 'email') {
                $this->errors[] = 'enter the correct email (the field is empty)';
            }

            if(empty($post[$key]) && $key == 'login') {
                $this->errors[] = 'enter the correct login (the field is empty)';
            }

            if(empty($post[$key]) && $key == 'name') {
                $this->errors[] = 'enter the correct name (the field is empty)';
            }

            if(empty($post[$key]) && $key == 'b_date') {
                $this->errors[] = 'enter the correct birthday date (the field is empty)';
            }

            if(empty($post[$key]) && $key == 'country_id') {
                $this->errors[] = 'enter the correct country (the field is empty)';
            }


            if (!empty($value)) {
                if ($key == 'password') {
                    continue;
                }
                $_SESSION['f_' . $key] = $value;
            }

            if ( !isset($value) || empty($value) ) { // все поля формы обязательные
                $checkIsset = false;
            }
        }

        if( !isset( $post['checkbox'] ) ) {
            $this->errors[] = 'You need to accept the terms';
            $checkIsset = false;
        }

        if($checkIsset) {
            return $post;
        }
        else {
            return false;
        }
        
        
    }

    private function getLoginData($post) 
    {
        $checkIsset = true;

        foreach($post as $value) {
            if( empty($value) ) {
                $checkIsset = false;
                $this->errors[] = 'Fill in all the fields';
            }
        }

        if( $checkIsset ) {
            if(!preg_match('/^((([0-9A-Za-z]{1}[-0-9A-z\.]{1,}[0-9A-Za-z]{1})|([0-9А-Яа-я]{1}[-0-9А-я\.]{1,}[0-9А-Яа-я]{1}))@([-A-Za-z]{1,}\.){1,2}[-A-Za-z]{2,})$/u', $post['emailOrLogin'])) {
                $this->login = $post['emailOrLogin'];
            }
             else {
                $this->email = $post['emailOrLogin'];
             }
             $this->password = $post['password'];

             return true;
        }
        else {
            return false;
        }

       
    }

    private function checkUserExist($registerData = '')
    {
        $users = new Users;

        $registeredPasswordData = $users->getPasswordUser(md5(md5(trim($this->password))));
        $registredUsersLogin = $users->getLoginUser($this->login);
        $registredUsersEmail = $users->getEmailUser($this->email);

        if( $this->login == NULL && isset($registerData['login']) && !empty($registerData['login']) ) {

            $registredUsersLogin = $users->getLoginUser($registerData['login']);
            $registredUsersEmail = $users->getEmailUser($registerData['email']);

            if( $registredUsersLogin['login'] == $registerData['login'] ||
                $registredUsersEmail['email'] == $registerData['email']) {

                if(isset($registredUsersLogin['login']) && !empty($registredUsersLogin['login'])) {
                    $this->errors[] = 'User with such login already exists';
                }

                if(isset($registredUsersEmail['email']) && !empty($registredUsersEmail['email'])) {
                    $this->errors[] = 'User with such email already exists';
                }

                return true;
            }
        }

        else if ( $this->login != NULL ) { 

            if($registredUsersLogin['login'] == $this->login && $registeredPasswordData) {
                return true;
            }
            else if($registredUsersLogin['login'] == $this->login && !$registeredPasswordData) {
                $this->errors[] = 'User with such password already exists';
                return false;
            }
            else {
                $this->errors[] = 'User not exists';
                return false;
            }
        }

        else if( $this->email != NULL ) {

            if( $registredUsersEmail['email'] == $this->email && $registeredPasswordData) {
                return true;
            }
            else if( $registredUsersEmail['email'] == $this->email && !$registeredPasswordData ) {
                $this->errors[] = 'User with such password does not exist';
                return false;
            }
            else {
                $this->errors[] = 'User with such email does not exist';
                return false;
            }

        }

        else { 
            return false;
        }

    
    }

}
