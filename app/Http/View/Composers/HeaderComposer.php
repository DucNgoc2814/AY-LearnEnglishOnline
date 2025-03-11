<?php

namespace App\Http\View\Composers;

use App\Models\Category;
use Illuminate\View\View;

/**
 * @package App\Http\View\Composers
 * @author Your Name
 * @description Composer for sharing header data across views
 */
class HeaderComposer
{
    /**
     * Bind data to the view
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view)
    {
        $categories = Category::with('courses')->get();
        $view->with('categories', $categories);
    }
}
