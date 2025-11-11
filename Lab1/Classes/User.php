<?php declare(strict_types=1);
    namespace Classes;
    class User extends AbstractUser
    {
        /**
         * @var string $name имя пользователя
         */
        public $name;
        /**
         * @var string $login почта пользователя
         */
        public $login;
        /**
         * @var string $password пароль пользователя
         */
        protected $password;
        public static $counter = 0;

        function __construct(string $name, string $login, string $password)
        {
            self::$counter++;
            $this->name = $name;
            $this->login = $login;
            $this->password = $password;
        }

        function __destruct()
        {
            echo 'Был вызван деструктор. Пользователь ' . $this->login . ' удалён<br>';
        }
        
        /**
         * Сеттер для пароля
         * @param string $input_password входной пароль пользователя
         * @return void
         */
        public function setPassword (string $input_password)
        {
            $this->password = $input_password;
        }

        /**
         * Геттер для пароля
         * @return string возращает значение пароля пользователя
         */
        public function getPassword ()
        {
            return $this->password;
        }
        /**
         * Вывод информации о пользователе
         * @return void
         */
        public function showInfo()
        {
            echo 'Имя: ' . $this->name . '<br>';
            echo 'Логин: ' . $this->login . '<br>';
            echo 'Пароль: ' . $this->password . '<br>';
        }
    }
?>