<?php
use Illuminate\Support\Facades\Request;
use Illuminate\Pagination\LengthAwarePaginator;
 function paginate($collection, $perPage = 5 )
    {

        // Get the current page number from the request query string
        $page = Request::get('page', 1);

        // Create a new collection instance by skipping the appropriate number of items
        $paginatedItems = $collection->skip(($page - 1) * $perPage)->take($perPage);

        // Create a new LengthAwarePaginator instance
        return new LengthAwarePaginator(
            $paginatedItems,
            $collection->count(),
            $perPage,
            $page,
            [
                'path' => Request::url(),
                'query' => Request::query(),
            ]
        );

    }

