<?php

namespace Nejcc\CustomTypes\Struct;

final class Point extends Struct
{
    public float $x;
    public float $y;

    public function __construct(float $x, float $y)
    {
        parent::__construct(compact('x', 'y'));
    }
}
