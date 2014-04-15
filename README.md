CFS Development Tools for WordPress
=============

This WordPress plugin allows you to easily place various development notes throughout your website. The development notes will appear on your page and the browser's console only when:
* You are working on your local development environment.
* You are logged into WordPress.
* ?devnote is appended to the URL.

## FEATURES:
* Allows you to add development notes which appear on your page and in the browser's console.
* Display in the page's footer the total number of SQL queries performed on the page and the total time required to generate the page.
* Basic PHP profiling in the browser's console.
* Colour-coded CSS debugging using https://github.com/mrmrs/pesticide/

## INSTALLATION:

1) Place in /wp-content/mu-plugins/ folder.

2) Make sure ENVIRONMENT and SAVEQUERIES constants are defined in your wp-config.php file.

    define('ENVIRONMENT', 'DEVELOPMENT');
    define('SAVEQUERIES', true );

Use https://github.com/cleanforestco/wp-config/blob/master/wp-config.php as a reference.

## USAGE:

1) Add Development Notes:

Display a development note on the website:

    <?php devnote('Here is a development note'); ?>

Display structured information about an array using var_dump()

    <?php $array = array("foo", "bar"); ?>
    <?php devnote($array); ?>
    
Optionally, pass a second parameter, false, to prevent the development note from displaying on your page. The development note will show in the browser's console only:

     <?php devnote('This will only display in the console', false); ?>

2) Display Development Notes by appending ?devnote to any page:

E.g., http://localhost/about-us/?devnote
