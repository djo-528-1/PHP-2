<?php

if (!isset($_GET['delete']) || !is_numeric($_GET['delete']) || $_GET['delete'] === NULL) {
    header("Location: news.php");
    exit();
}

$id = intval($_GET['delete']);

if ($news->deleteNews($id)) {
    header("Location: news.php");
    exit;
}
else {
    $errMsg = "Произошла ошибка при удалении новости";
}