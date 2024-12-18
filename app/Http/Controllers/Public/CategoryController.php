<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller {
    //

    public function index() {
        $categories = Category::withCount( 'events' )->get();

        return view( 'public.categories.index', [
            'categories' => $categories
        ] );
    }

    public function events( Category $category ) {

        return view( 'public.categories.events', [
            'events' => $category->events,
            'category' => $category
        ] );
    }
}
