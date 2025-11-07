<?php
spl_autoload_register();

use Singleton\Settings;

$settings = Settings::get();

$settings->number_var = 12;
$settings->text_var = 'Just text';
$settings->bool_var = false;

echo 'Числовое значение: ' . $settings->number_var . '<br>';
echo 'Текстовое значение: ' . $settings->text_var . '<br>';
echo 'Логическое значение: ' . ($settings->bool_var ? 'true' : 'false') . '<br>';