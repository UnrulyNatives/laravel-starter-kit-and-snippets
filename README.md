
# Demo

http://dev.unrulynatives.com

# What it is
1. This is an instance of Laravel PHP Framework 5.3. A starter app. Its philosophy is slightly different than similar starter kits. Here are the highlights:

- all changes made over the original Laravel App have COMMENTS FOR BEGINNERS. You can delete them as soon as you consider them not necessary. 

- some solutions have variants, so that everyone one can pick the variant which suits their needs of the moment

- I have installed theme system (igaster/laravel-theme) to provide solutions for different CSS frameworks. You can switch between them at will:

3. I am an amateur programmer, not a pro. The repository is a self-teaching tutorial, in a sense. This app was originally my private repository of snippets, solutions, answers from StackOverflow and ideas to approach my needs. It aggregates all code which might come useful, and was appplied across many various projects.

### for the original Laravel Framework go to [Laravel Repository](https://github.com/laravel/laravel)




## FEATURES


## Admin tools

- Mass removal of records with field `status` == `null`. Easily adjustable for other purposes.





## Handy solutions

- A gravatar displaying code (see `App/User.php` @ getGravatarAttribute)
    - User AVATAR supported by Gravatar or locally - by user's choice






### CSS/JS hacks and improvements over used frameworks:
    - Bootstrap: dropdown on hover  (see `css/common_elements.css`)
    - Bootstrap: button with icon on one side. See example at `docs/components_common`.

    - CSS classes for common CSS elements which I use most frequently. All are listed here `docs/components_common`


### JS SCRIPTS

    - a script to load DOM patches via jQuery
    - a script to set hash value when switching between tabs on a page


### OTHER FEATURES

    - QR code generator for any page, reloads for changes of hashtag value (See JS feature above)


### Admin tools

    - `/admin/server-status` - this page displays server status and php version


### PRECONFIGURED PACKAGES

    // this is the `collective` equivalent - used temporarily for the still unreleased Laravel 5.3
        "laravie/html": "~5.3",

    // Theme system. This App uses it for switching between CSS frameworks
        "igaster/laravel-theme": "~1",

    // A complete roles/auth solution. 
        "spatie/laravel-permissions": "2.1.*@dev",
        See URL `admintools/assign-roles`


    // detects if user is using a mobile or a desktop device
        "jenssegers/agent" : "~2.3",

    // slugs
        "cviebrock/eloquent-sluggable": "dev-master",

    // a simple admin panel
        "laraveldaily/quickadmin": "^1.1",

    // tagging for models
        "rtconner/laravel-tagging": "2.*",

    // comment system
        "slynova/laravel-commentable": "^2.0"
        This system supports replies at multiple level.

    Tracking user activity 
    // "spatie/laravel-activitylog": "^1.2",
        See URL `admintools/user-track`



## Installation steps

1. Pull the repository to your local drive
2. run `composer install`. You have to install the Composer itself to do that. See [Composer Download Page](https://getcomposer.org/download/).
3. Generate application key with shell command `artisan key:generate`
4. clone the file `.env.example` and rename it to `.env`
5. Create and populate the database. Make sure that 
- you would place the DB credentials to the `.env` file 
    DB_CONNECTION=mysql // this is the default mysql database connection. You can define extra connections later.
    DB_DATABASE=homestead
    DB_USERNAME=homestead
    DB_PASSWORD=secret

- in your `config/database.php` you would make the `mysql` connection refer to your `.env` file.

6. Initiate the Laravel's bundled authentication functions. As described here
use `php artisan make:auth` commmand. 

You would also need to create tables in your database. Use `php artisan migrate` to do that.


### LAST STEP
After completing the above steps the app should work. 
Point your browser to the `localhost/APP_FOLDER/public/`.. You should see the landing page. (This solution required DB connection to work properly)
Point your browser to the `localhost/APP_FOLDER/public/welcome`.. You should see the landing page. (You will see the standard welcome screen delivered by Laravel)



## Contribution guide



## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
