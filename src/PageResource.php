<?php

namespace Remipou\NovaPageManager;

use App\Nova\Resource;
use R64\NovaFields\Text;
use R64\NovaFields\Image;
// use Laravel\Nova\Fields\Text;
// use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Fields\Select;

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
        return 'Pages';
    }

    public static function singularLabel()
    {
        return 'Page';
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

            Select::make('Template')
                ->options(array_combine($this->getTemplates(), $this->getTemplates()))
                ->onlyOnForms(),

            Text::make('Name')
                ->resolveUsing(function () {
                    return '<a target="_blank" href="'.url($this->slug).'">'.$this->name.'</a>';
                })
                ->asHtml()
                ->exceptOnForms(),

            Text::make('Name')
                ->rules('required', 'max:255')
                ->onlyOnForms(),

            Text::make('Title')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Slug')->sortable(),

            Select::make('Template')
                ->options(array_combine($this->getTemplates(), $this->getTemplates()))
                ->exceptOnForms(),

            Trix::make('Content')
                ->withFiles('public')
                ->hideFromIndex(),

            Text::make('Meta title', 'meta_title')
                ->hideFromIndex(),

            Text::make('Meta description', 'meta_description')
                ->hideFromIndex(),

            Image::make('OG image', 'og_image')
                ->disk('public')
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
