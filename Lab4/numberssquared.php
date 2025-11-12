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

    public function rewind() : void
    {
        $this->current = $this->start;
    }

    public function valid() : bool
    {
        return $this->current <= $this->end;
    }

    public function next() : void
    {
        $this->current++;
    }

    public function key() : mixed
    {
        return $this->current;
    }

    public function current() : mixed
    {
        return $this->current ** 2;
    }
}

$numsqr = new NumbersSquared(3, 7);
foreach ($numsqr as  $num => $square)
{
    echo "Квадрат числа $num = $square<br>";
}