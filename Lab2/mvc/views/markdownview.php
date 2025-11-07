<?php
namespace MVC\Views;

class MarkdownView
{
    private array $users;

    public function __construct(array $users)
    {
        $this->users = $users;
    }

    public function render(): string
    {
        $markdown = "# Пользователи\n\n";

        foreach ($this->users as $user)
        {
            $markdown .= "- **Имя:** {$user->first_name} **Фамилия:** {$user->last_name}\n- **Email:** {$user->email}\n\n";
        }
        return $markdown;
    }
}