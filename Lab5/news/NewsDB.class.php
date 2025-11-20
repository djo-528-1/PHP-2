<?php

require_once 'INewsDB.class.php';

class NewsDB implements INewsDB, IteratorAggregate
{
    const DB_NAME = 'news.db';
    const RSS_NAME = 'rss.xml';
    const RSS_TITLE = 'Последние новости';
    const RSS_LINK = 'http://f1187779.xsph.ru/Lab5/news/news.php';
    private $_db;
    private array $items = [];

    public function __construct()
    {
        if (!file_exists(self::DB_NAME)) {
            $this->_db = new SQLite3(self::DB_NAME);

            $sql = file_get_contents('news.txt');
            $this->_db->exec($sql);

        }
        else {
            $this->_db = new SQLite3(self::DB_NAME);
        }
        $this->getCategories();
    }

    public function __destruct()
    {
        if ($this->_db) {
            $this->_db->close();
        }
    }

    protected function getDb()
    {
        return $this->_db;
    }

    function saveNews($title, $category, $description, $source)
    {
        $dt = time();

        $stmt = $this->_db->prepare(
            "INSERT INTO msgs (title, category, description, source, datetime) VALUES (:title, :category, :description, :source, :datetime)"
        );
        if ($stmt === false) {
            die('Ошибка подготовки запроса: ' . $this->_db->lastErrorMsg());
        }
        $stmt->bindValue(':title', $title, SQLITE3_TEXT);
        $stmt->bindValue(':category', $category, SQLITE3_INTEGER);
        $stmt->bindValue(':description', $description, SQLITE3_TEXT);
        $stmt->bindValue(':source', $source, SQLITE3_TEXT);
        $stmt->bindValue(':datetime', $dt, SQLITE3_INTEGER);
        
        $result = $stmt->execute();

        if ($result !== false)
        {
            $this->createRss();
        }
        return $result !== false;
    }

    function getNews()
    {

        $sql = "
            SELECT msgs.id as id, title, category.name as category, description, source, datetime
            FROM msgs, category
            WHERE category.id = msgs.category
            ORDER BY msgs.id DESC
        ";

        $result = $this->_db->query($sql);
        if (!$result) {
            return false;
        }

        $news = [];
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $news[] = $row;
        }

        return $news;
    }

    function deleteNews($id)
    {        
        $stmt = $this->_db->prepare("DELETE FROM msgs WHERE id = :id");
        if (!$stmt) {
            return false;
        }
        $stmt->bindValue(':id', (int)$id, SQLITE3_INTEGER);
        $result = $stmt->execute();

        return $result !== false && $this->_db->changes() > 0;
    }

    private function getCategories()
    {
        $db = new SQLite3(__DIR__ . '/news.db');
        $stmt = $db->prepare('SELECT id, name FROM category');
        $result = $stmt->execute();
        while ($row = $result->fetchArray(SQLITE3_ASSOC))
        {
            $this->items[(int)$row['id']] = $row['name'];
        }
        $db->close();
    }

    function getIterator() : Traversable
    {
        return new ArrayIterator($this->items);
    }

    function createRss()
    {
        $dom = new DOMDocument('1.0', 'utf-8');
        $dom->formatOutput = true;
        $dom->preserveWhiteSpace = false;
        $rss = $dom->createElement('rss');
        $version = $dom->createAttribute('version');
        $version->value = '2.0';
        $rss->appendChild($version);
        $dom->appendChild($rss);

        $channel = $dom->createElement('channel');
        $rss->appendChild($channel);
        $channel->appendChild($dom->createElement('title', self::RSS_TITLE));
        $channel->appendChild($dom->createElement('link', self::RSS_LINK));

        $newsArr = $this->getNews();
        if ($newsArr === false)
        {
            $newsArr = [];
        }
        foreach ($newsArr as $news)
        {
            $item = $dom->createElement('item');
            $item->appendChild($dom->createElement('title', htmlspecialchars($news['title'], ENT_XML1, 'UTF-8')));
            $newsLink = self::RSS_LINK . '?id=' . (int) $news['id'];
            $item->appendChild($dom->createElement('link', $newsLink));
            $description = $dom->createElement('description');
            $cdata_description = $dom->createCDATASection($news['description']);
            $description->appendChild($cdata_description);
            $item->appendChild($description);
            $pubDate = date('r', (int) $news['datetime']);
            $item->appendChild($dom->createElement('pubDate', $pubDate));
            $item->appendChild($dom->createElement('category', htmlspecialchars($news['category'], ENT_XML1, 'UTF-8')));
            $channel->appendChild($item);
        }
        return $dom->save(self::RSS_NAME) !== false;
    }
}