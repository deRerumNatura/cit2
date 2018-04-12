<?php
/**
 * Created by PhpStorm.
 * User: марк
 * Date: 26.01.2018
 * Time: 19:02
 */

namespace application\controllers;
use application\core\Controller;
use application\models\Users;

class AdminController extends Controller
{

    public function __construct($route, array $url_params = [], array $post_vars = [])
    {
        parent::__construct($route, $url_params, $post_vars);

        if (!isset($_SESSION['login']) || empty($_SESSION['login'])) {
            header("location: /login]");
        }

        $this->view->layout = 'admin';
    }

    public function index()
    {
        $this->view->render('Admin');
    }

}