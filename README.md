# Skyltdax Theme

Custom built theme for Skyltdax.se and "sub sites" for our countries. The Wordpress installation is a Multisite, with 1 site per country.

Currently the site lives on http://skyltdax.hemsida.eu.

The site uses WooCommerce, Polylang, Advanced Custom Fields PRO, Yoast SEO and Wordfence (for basic protection).

## WooCommerce

All functionality connected to WooCommerce is custom built. The goal is to use as few plugins as possible, the Wordpress version is planned to live for a long time, thus avoiding being exposed to third party functionality is key.

## Editor

The sign editor is built with VUE 2, and the sign image generation is built with HTML Canvas. Webpack handling of the JS is not setup 100%, but will be. A build step for both CSS and the JS is in the pipeline.

## Compile CSS

To make CSS from SCSS run ```yarn install``` or ```npm install```.

Then run ```yarn scss``` or ```npm scss```.

## CI

Github Actions are setup to install the theme on the server from the ```master``` branch.

Please create feature branches from ```master``` and do PR's towards ```master``` adding at least one reviewer to your PR.
