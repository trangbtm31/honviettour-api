<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>



## HONVIETOUR

1. ##### Admin setup guide:

```bash
# get source code
	git clone https://github.com/trangbtm31/honviettour-api.git
	
# setup, install components
	# basic
    composer install
    php artisan migrate
    php artisan storage:link
    # laravel-admin
    php artisan vendor:publish --provider="Encore\Admin\AdminServiceProvider"
    php artisan admin:install
    # laravel-admin extensions 
    php artisan admin:import helpers
    php artisan admin:import media-manager
    php artisan vendor:publish --tag=api-tester
    php artisan admin:import log-viewer
    php artisan admin:import config
    php artisan admin:import composer-viewer        
    php artisan vendor:publish --tag=laravel-admin-summernote

```

2. ##### API setup guide:

