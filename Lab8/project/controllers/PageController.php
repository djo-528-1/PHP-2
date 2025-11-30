<?php
namespace Project\Controllers;
use \Core\Controller;
use \Project\Models\Page;

class PageController extends Controller
{
    private $pages = [
        1 => ['title'=>'страница 1', 'text'=>'текст страницы 1'],
        2 => ['title'=>'страница 2', 'text'=>'текст страницы 2'],
        3 => ['title'=>'страница 3', 'text'=>'текст страницы 3'],
    ];
    
    public function one($params)
    {
        $page = (new Page) -> getById($params['id']);
        
        if ($page)
        {
            $this->title = $page['title'];
            return $this->render('page/one', [
                'text' => $page['text'],
                'h1' => $this->title
            ]);
        }
        else
        {
            $this->title = 'Страница не найдена';
            return $this->render('page/notFound', [
                'id' => $params['id']
            ]);
        }
    }
    
    public function all()
    {
        $this->title = 'Список всех страниц';
        
        $pages = (new Page) -> getAll();
        return $this->render('page/all', [
            'pages' => $pages,
            'h1' => $this->title
        ]);
    }
}