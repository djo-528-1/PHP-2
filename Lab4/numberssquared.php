<?php

class NumbersSquared implements Iterator
{
    private int $start;
    private int $end;
    private int $current;

    public function __construct (int $start, int $end)
    {
        $this->start = $start;
        $this->end = $end;
        $this->current = $start;
    }

    public function rewind()
    {
        $this->current = $this->start;
    }

    public function valid()
    {
        return $this->current <= $this->end;
    }

    public function next()
    {
        $this->current++;
    }

    public function key()
    {
        return $this->current;
    }

    public function current()
    {
        return $this->current ** 2;
    }
}

$numsqr = new NumbersSquared(3, 7);
foreach ($numsqr as  $num => $square)
{
    echo "Квадрат числа $num = $square\n";
}