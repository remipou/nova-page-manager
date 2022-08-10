<?php

namespace Remipou\NovaPageManager;

use Illuminate\Routing\Controller;

class PageController extends Controller
{
    public function page($slug = null)
    {
        $slug = $slug ? $slug : '/';
        $page = Page::findBySlug($slug);
        if (! $page) {
            abort(404);
        }

        return view(config('pagemanager.templates_location').'.'.$page->template, ['page' => $page]);
    }
}
