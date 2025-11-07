<?php
spl_autoload_register();

use MVC\Views\MarkdownView;
use MVC\Models\Users;

$obj = new Users();
$view = new MarkdownView($obj->collection);
echo nl2br($view->render());