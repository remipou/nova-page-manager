<?php

namespace Remipou\NovaPageManager;

use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class TemplateFilter extends Filter
{
    /**
     * Apply the filter to the given query.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(Request $request, $query, $value)
    {
        return $query->where('template', $value);
    }

    /**
     * Get the filter's available options.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function options(Request $request)
    {
        return array_combine($this->getTemplates(), $this->getTemplates());
    }

    protected function getTemplates()
    {
        return array_map(function ($file) {
            return explode('.', $file->getFilename())[0];
        }, \File::allFiles(resource_path($this->getTemplatesPath())));
    }

    protected function getTemplatesPath()
    {
        return 'views/'.str_replace('.', '/', config('pagemanager.templates_location'));
    }
}
