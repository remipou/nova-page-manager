<?php

namespace Remipou\NovaPageManager;

use Laravel\Nova\Resource;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;

class PageResource extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'Remipou\NovaPageManager\Page';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name', 'title',
    ];

    public static function label()
    {
        return __('Pages');
    }

    public static function singularLabel()
    {
        return __('Page');
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            Select::make(__('Template'), 'template')
                ->options(array_combine($this->getTemplates(), $this->getTemplates()))
                ->onlyOnForms(),

            Text::make(__('Name'), 'name')
                ->displayUsing(function () {
                    return '<a target="_blank" href="'.route('page-manager', ['slug' => $this->slug]).'">'.strip_tags($this->name).'</a>';
                })
                ->asHtml()
                ->exceptOnForms(),

            Text::make(__('Name'), 'name')
                ->rules('required', 'max:255')
                ->onlyOnForms(),

            Text::make(__('Title'), 'title')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Slug')->sortable(),

            Select::make(__('Template'), 'template')
                ->options(array_combine($this->getTemplates(), $this->getTemplates()))
                ->exceptOnForms(),

            Trix::make(__('Content'), 'content')
                ->withFiles('public')
                ->hideFromIndex(),

            Text::make(__('Meta title'), 'meta_title')
                ->hideFromIndex(),

            Text::make(__('Meta description'), 'meta_description')
                ->hideFromIndex(),

            Image::make(__('OG image'), 'og_image')
                ->disk(config('pagemanager.images_disk'))
                ->path(config('pagemanager.images_location'))
                ->storeOriginalName('og_image_name')
                ->prunable()
                ->hideFromIndex(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [
            new TemplateFilter,
        ];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
