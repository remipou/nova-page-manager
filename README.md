# A page manager for Nova
A simple page manager to use with Laravel and Nova. 

## Installation
Install with composer:
```bash
composer require remipou/novapagemanager
```

Publish configuration, views and migrations:
```bash
php artisan vendor:publish --provider="Remipou\NovaPageManager\PageManagerServiceProvider"
```

Run the migrations
```bash
php artisan migrate
```

Register the resource in NovaServiceProvider:
```php
use Remipou\NovaPageManager\PageResource;

protected function resources() {
    Nova::resourcesIn(app_path('Nova'));

    Nova::resources([
        PageResource::class,
    ]);
}
```

Add this at the end of your `routes/web.php`:
```php
Route::get('{slug}/{param?}', '\Remipou\NovaPageManager\PageController@page')
	->where('slug', '^((?!' . trim(config('nova.path'), '/') . ').)*$');
```

## Screenshots


## Roadmap
- add hierarchy (parent/child pages)
- add a menu manager

### Changelog
- 1.0.0 first version

### Credits
- [Rémi Puig](https://github.com/remipou)

### License
The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
