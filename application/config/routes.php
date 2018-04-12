<?php
if(FULL_PATH == '') {
    return [
        '' => [
            'controller' => 'auth',
            'action' => 'index'
        ],
        'singup' => [
            'controller' => 'auth',
            'action' => 'showSingUp'
        ],
        'singin' => [
            'controller' => 'auth',
            'action' => 'showSingIn'
        ],
        'login' => [
            'controller' => 'auth',
            'action' => 'login'
        ],
        'register' => [
            'controller' => 'auth',
            'action' => 'register'
        ],
        'logout' => [
            'controller' => 'auth',
            'action' => 'logout'
        ],
        'admin' => [
            'controller' => 'admin',
            'action' => 'index'
        ],

    ];
}
else {
    $path = substr(FULL_PATH, 1);
    return [
        $path.'' => [
            'controller' => 'auth',
            'action' => 'index'
        ],
        $path.'/singup' => [
            'controller' => 'auth',
            'action' => 'showSingUp'
        ],
        $path.'/singin' => [
            'controller' => 'auth',
            'action' => 'showSingIn'
        ],
        $path.'/login' => [
            'controller' => 'auth',
            'action' => 'login'
        ],
        $path.'/register' => [
            'controller' => 'auth',
            'action' => 'register'
        ],
        $path.'/logout' => [
            'controller' => 'auth',
            'action' => 'logout'
        ],
        $path.'/admin' => [
            'controller' => 'admin',
            'action' => 'index'
        ],

    ];
}

