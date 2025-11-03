<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class BooksFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];


    public function category($id)
    {
        return $this->where('category_id', $id);
    }

    public function search($name)
    {
        return $this->where(function ($q) use ($name) {
            return $q->where('title', 'LIKE', $name . '%')->orWhere('desc', 'LIKE', '%' . $name . '%');
        });
    }
}