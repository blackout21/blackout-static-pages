Static Pages for Blackout21
===========================

This project provides static HTML pages, which you can use on *March 21st*, 2019 on your own domain to inform
everybody about EU's copyright reform.


Usage
-----

You just can download and use the `blackout_*.html` files. These files do not have any external CSS or JavaScript.


Develop
-------

If you want to add, modify or improve the static pages, you can use the generator tool located at `bin/generate.php`.
It requires Composer and PHP 7.1 or higher.

These commands will regenerate static pages from available languages (in `translations`) and the template (in `src`): 

    composer install
    php bin/generate.php

If you want to add a new language, just add a new JSON file to `translations` directory.

To ensure simpler use for others, rendered static pages should be committed to this repository.
