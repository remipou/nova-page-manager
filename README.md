[![Latest Stable Version](https://poser.pugx.org/remipou/nova-page-manager/v/stable)](https://packagist.org/packages/remipou/nova-page-manager)
[![Total Downloads](https://poser.pugx.org/remipou/nova-page-manager/downloads)](https://packagist.org/packages/remipou/nova-page-manager)
[![Latest Unstable Version](https://poser.pugx.org/remipou/nova-page-manager/v/unstable)](https://packagist.org/packages/remipou/nova-page-manager)
[![License](https://poser.pugx.org/remipou/nova-page-manager/license)](https://packagist.org/packages/remipou/nova-page-manager)
[![StyleCI](https://github.styleci.io/repos/152878593/shield?branch=master)]

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

## Usage
Create templates in `resources/views/templates`. Route and Controller are included but you need to style your templates.

## Screenshots
<img width="1416" alt="screenshot1" src="https://user-images.githubusercontent.com/4225911/46909231-2d95ba80-cf2f-11e8-9bdd-dc7659e83704.png">

<img width="1353" alt="screenshot2" src="https://user-images.githubusercontent.com/4225911/46909234-3090ab00-cf2f-11e8-8537-26ac030b872f.png">


## Roadmap
- add markup to content
- add hierarchy (parent/child pages)
- add a menu manager
- add a page builder

### Changelog
- 1.0.0 first version

### Credits
- [Rémi Puig](https://github.com/remipou)

### License
The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
