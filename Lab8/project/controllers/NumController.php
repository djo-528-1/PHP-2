<?php
namespace Project\Controllers;
use \Core\Controller;

class NumController extends Controller
{
    public function sum($param)
    {
        $this->title = 'Сумма чисел';

        $n1 = isset($param['n1']) ? (int)$param['n1'] : 0;
        $n2 = isset($param['n2']) ? (int)$param['n2'] : 0;
        $n3 = isset($param['n3']) ? (int)$param['n3'] : 0;
        $sum = $n1 + $n2 + $n3;

        $data = [
            'n1' => $n1,
            'n2' => $n2,
            'n3' => $n3,
            'sum' => $sum
        ];
        return $this->render('num/sum', $data);
    }
}