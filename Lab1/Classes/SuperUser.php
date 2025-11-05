<?php declare(strict_types=1);
    namespace Classes;
    class SuperUser extends User implements SuperUserInterface
    {
        /**
         * @var $role роль пользователя
         */
        public $role;

        function __construct(string $name, string $login, string $password, string $role)
        {
            parent::__construct($name, $login, $password);
            $this->role = $role;
        }
        /**
         * Вывод информации о супер-пользователе
         * @return void
         */
        public function showInfo()
        {
            parent::showInfo();
            echo 'Роль: ' . $this->role . '<br>';
        }

        function getInfo()
        {}
    }
?>