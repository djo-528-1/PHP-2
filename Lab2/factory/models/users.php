<?php
namespace Factory\Models;

class Users extends Collection
{
    public function __construct(public ?array $users = null)
    {
        $users ??= [
            new User(
                'dmitry.koterov@gmail.com',
                'password',
                'Дмитрий',
                'Котеров'
            ),
            new User(
                'igorsimdyanov@gmail.com',
                'password',
                'Игорь',
                'Симдянов'
            ),
            new User(
                'chel@gmail.com',
                '123456',
                'Человек',
                'Человеков'
            ),
            new User(
                'pochta@gmail.com',
                'adm1n',
                'Иван',
                'Иванов'
            ),
            new User(
                'dfsdjfnvkjgbh@gmail.com',
                'wsfsjkfn',
                'Kjsfdiv',
                'Jjkcsn'
            )
        ];
        parent::__construct($users);
    }
}
