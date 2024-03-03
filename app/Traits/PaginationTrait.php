<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

trait PaginationTrait
{

    protected function paginateCollection($collection, $perPage = 10)
    {
        $currentPage = request()->query('page', 1);

        $offset = ($currentPage - 1) * $perPage;
        $currentPageItems = $collection->slice($offset, $perPage)->all();

        return new LengthAwarePaginator(
            $currentPageItems,
            $collection->count(),
            $perPage,
            $currentPage,
        );
    }
}
