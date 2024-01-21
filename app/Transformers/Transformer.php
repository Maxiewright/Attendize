<?php

namespace App\Transformers;

abstract class Transformer
{
    /**
     * @return array
     */
    abstract public function transform($item);

    /**
     * @return array
     */
    public function transformCollection(array $items)
    {
        return array_map([$this, 'transform'], $items);
    }
}
