CFS Development Tools for WordPress
=============

This WordPress plugin allows you to place various development notes throughout your website. The development notes will only appear when:
* You are working on your local development environment.
* You are logged into WordPress.
* ?devnote is appended to the URL.

This plugin will also display in the page's footer the total number of SQL queries performed on the page and the total time required to generate the page.

INSTALLATION:

1) Place in /wp-content/mu-plugins/ folder.

2) Make sure ENVIRONMENT and SAVEQUERIES constants are defined in your wp-config.php file.

    define('ENVIRONMENT', 'DEVELOPMENT');
    define('SAVEQUERIES', true );

Use https://github.com/cleanforestco/wp-config/blob/master/wp-config.php as a reference.

USAGE:

1) Add Development Notes:

Display a development note on the website:
    <?php devnote('Here is a development note.'); ?>

Display structured information about an array using var_dump()
    <?php devnote($array); ?>

2) Display Development Notes by appended ?devnote to any page:

E.g., http://localhost/about-us/?devnote
