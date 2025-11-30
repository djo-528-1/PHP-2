<?php
namespace Project\Controllers;
use \Core\Controller;
use \Project\Models\Product;

class ProductController extends Controller
{
    public function one($params)
    {
        $product = (new Product) -> getById($params['id']);
        
        if ($product)
        {
            $this->title = $product['name'];
            return $this->render('product/one', [
                'name' => $product['name'],
                'price' => $product['price'],
                'quantity' => $product['quantity'],
                'category' => $product['category'],
                'h1' => $this->title
            ]);
        }
        else
        {
            $this->title = 'Продукт не найден';
            return $this->render('product/notFound', [
                'id' => $params['id']
            ]);
        }
    }
    
    public function all()
    {
        $this->title = 'Список всех продуктов';

        $products = (new Product) -> getAll();
        return $this->render('product/all', [
            'products' => $products,
            'h1' => $this->title
        ]);
        
    }
}