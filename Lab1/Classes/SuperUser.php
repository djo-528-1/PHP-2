<?php declare(strict_types=1);
    namespace Classes;
    class SuperUser extends User implements SuperUserInterface
    {
        /**
         * @var $role роль пользователя
         */
        public $role;
        public static $counter = 0;

        function __construct(string $name, string $login, string $password, string $role)
        {
            self::$counter++;
            $this->name = $name;
            $this->login = $login;
            $this->password = $password;
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
        {
            $result = [];
            $rc = new \ReflectionClass($this);
            $attributes = $rc->getProperties();

            foreach ($attributes as $attribute)
            {
                if (!$attribute->isStatic())
                {
                    $name = $attribute->getName();
                    $result[$name] = $this->{$name};
                }
            }

            return $result;
        }
    }
?>