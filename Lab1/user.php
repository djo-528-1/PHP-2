<?php declare(strict_types=1);
    use Classes\User;
    use Classes\SuperUser;

    function autoloader ($className)
    {
        $classFile = str_replace('\\', '/', $className) . '.php';
        if (file_exists($classFile))
            require_once ($classFile);
    }

    spl_autoload_register('autoloader');
    
    // require 'Classes/User.php';
    // require 'Classes/SuperUser.php';
    /* $user1 = new User();
    $user1->name = 'Ivan';
    $user1->login = 'loginIvan';
    $user1->setPassword('admin');
    $user2 = new User();
    $user2->name = 'KrytoiIvan';
    $user2->login = 'loginKrytoiIvan';
    $user2->setPassword('password_KrytoiIvan');
    $user3 = new User();
    $user3->name = 'Gosling';
    $user3->login = 'loginGosling';
    $user3->setPassword('password_Gosling'); */

    $user1 = new User('Ivan', 'loginIvan', 'adm1n');
    $user2 = new User('KrytoiIvan', 'loginKrytoiIvan', 'password_KrytoiIvan');
    $user3 = new User('Gosling', 'loginGosling', 'password_Gosling');

    $user1->showInfo();
    $user2->showInfo();
    $user3->showInfo();

    $super_user = new SuperUser('Admin', 'loginAdmin', 'passwordAdmin', 'admin');
    $super_user->showInfo();
    print_r($super_user->getInfo());
    echo '<br>';

    echo 'Всего обычных пользователей: ' . User::$counter . '<br>';
    echo 'Всего супер пользователей: ' . SuperUser::$counter . '<br>';

    unset($user1);
    unset($user2);
    unset($user3);
    unset($super_user);
?>