<?php

namespace App\Util;


class Calculator
{
    public function add($n1, $n2)
    {
        return $n1 + $n2;
    }

    public function subtract($n1, $n2)
    {
        return $n1 - $n2;
    }

    public function divide($n, $divisor)
    {
        if(empty($divisor)){
            throw new \InvalidArgumentException("Divisor must be a number");
        }

        return $n / $divisor;
    }
}

