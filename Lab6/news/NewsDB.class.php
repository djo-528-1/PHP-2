<?php
require_once 'INewsDB.class.php';

class NewsDB implements INewsDB
{
    const DB_DSN = 'sqlite:news.db';
    private $_db;

    public function __construct()
    {
        $new_db_flag = !file_exists('news.db') || filesize('news.db') === 0;
        try
        {
            $this->_db = new PDO(self::DB_DSN);
            $this->_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            if ($new_db_flag)
            {
                $this->_db->beginTransaction();
                
                $sql = file_get_contents('news.txt');
                $this->_db->exec($sql);

                $sql_category = "INSERT INTO category (id, name) VALUES (1, 'Политика'), (2, 'Культура'), (3, 'Спорт');";
                $this->_db->exec($sql_category);
                $this->_db->commit();
            }
        }
        catch (PDOException $e)
        {
            if($this->_db->inTransaction())
            {
                $this->_db->rollBack();
            }
            echo 'Ошибка создания базы данных: ' . $e->getMessage() . '<br>';
            exit();
        }
    }

    public function __destruct()
    {
        // В PDO для закрытия соединения достаточно присвоения null
        if ($this->_db) {
            $this->_db = null;
        }
    }

    protected function getDb()
    {
        return $this->_db;
    }

    function saveNews($title, $category, $description, $source)
    {
        $dt = time();

        try
        {
            $stmt = $this->_db->prepare(
                "INSERT INTO msgs (title, category, description, source, datetime) VALUES (:title, :category, :description, :source, :datetime)"
            );
            
            $stmt->bindValue(':title', $title, PDO::PARAM_STR);
            $stmt->bindValue(':category', $category, PDO::PARAM_INT);
            $stmt->bindValue(':description', $description, PDO::PARAM_STR);
            $stmt->bindValue(':source', $source, PDO::PARAM_STR);
            $stmt->bindValue(':datetime', $dt, PDO::PARAM_INT);

            return $stmt->execute();
        }
        catch (PDOException $e)
        {
            echo 'Ошибка сохранения новости: ' . $e->getMessage() . '<br>';
            return false;
        }
    }

    function getNews()
    {
        try
        {
            $sql = "
            SELECT msgs.id as id, title, category.name as category, description, source, datetime
            FROM msgs, category
            WHERE category.id = msgs.category
            ORDER BY msgs.id DESC
            ";

            $result = $this->_db->query($sql);
            if (!$result)
            {
                return false;
            }

            $news = [];
            while ($row = $result->fetch(PDO::FETCH_ASSOC))
            {
                $news[] = $row;
            }
            return $news;
        }
        catch (PDOException $e)
        {
            echo 'Ошибка получения новостей: ' . $e->getMessage() . '<br>';
        }
    }

    function deleteNews($id)
    {
        try
        {
            $stmt = $this->_db->prepare("DELETE FROM msgs WHERE id = :id");
            $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
            $result = $stmt->execute();
            return $result !== false && $stmt->rowCount() > 0;
        }
        catch (PDOException $e)
        {
            echo 'Ошибка удаления новости: ' . $e->getMessage() . '<br>';
        }
    }
}