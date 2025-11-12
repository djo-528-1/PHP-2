<?php
$allNews = $news->getNews();

if ($allNews === false) {
    $errMsg = "Произошла ошибка при выводе новостной ленты";
    echo "<div class='error'>" . htmlspecialchars($errMsg) . "</div>";
}
else {
    $allNewsCount = count($allNews);
    if($allNewsCount){
    echo "<p>Всего новостей: " . $allNewsCount . "</p>";
    foreach ($allNews as $item) {
        echo "<div style='border: 1px solid #008cffff; margin: 5px; padding: 5px;'>";
        echo "<h3>" . htmlspecialchars($item['title']) . "</h3>";
        echo "<p><strong>Категория:</strong> " . htmlspecialchars($item['category']) . "</p>";
        echo "<p>" . htmlspecialchars($item['description']) . "</p>";
        echo "<p><em>Источник:</em> " . htmlspecialchars($item['source']) . "</p>";
        echo "<p><small>" . date('d.m.Y H:i', $item['datetime']) . "</small></p>";
        echo "<p><a href='?delete=" . $item['id'] . "' onclick='return confirm(\"Удалить?\")'>Удалить</a></p>";
        echo "</div>";
    }
    }
    else
        echo "<p>Нет новостей. Добавьте новость</p>";
}