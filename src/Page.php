<?php

namespace Remipou\NovaPageManager;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use SoftDeletes, Sluggable, SluggableScopeHelpers;

    protected $fillable = [
        'template',
        'name',
        'title',
        'slug',
        'content',
        'extras',
        'images',
        'meta_title',
        'meta_description',
        'og_image',
        'og_image_name',
    ];

    protected $cast = [
        'extras' => 'array',
    ];

    public function getTemplates()
    {
        return array_map(function ($file) {
            return explode('.', $file->getFilename())[0];
        }, \File::allFiles(resource_path($this->getTemplatesPath())));
    }

    public function getTemplate($template)
    {
        return view()->exists($this->getTemplatesLocation().'.'.$template) ? $this->getTemplatesLocation().'.'.$template : 'novapagemanager::default';
    }

    protected function getTemplatesLocation()
    {
        return config('pagemanager.templates_location');
    }

    protected function getTemplatesPath()
    {
        return 'views/'.str_replace('.', '/', $this->getTemplatesLocation());
    }

    public function getSanitizedContentAttribute()
    {
        return preg_replace('/(<a.*figure.*>)((<img.*)(width="\d+" height="\d+")(>))(<figcaption.*<span.*>((.*)\..*)<\/span>.*<\/a>)/U', '$3class="image-$8"$5', $this->content);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'source',
            ],
        ];
    }

    public function getSourceAttribute()
    {
        return $this->slug && $this->slug !== '' ? $this->slug : $this->title;
    }

    public function getMetaTitleAttribute($value)
    {
        return $value === null ? $this->title : $value;
    }
}
