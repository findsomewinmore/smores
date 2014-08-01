# [S'mores](https://github.com/findsomewinmore/smores)

[![Built with Grunt](https://cdn.gruntjs.com/builtwith.png)](http://gruntjs.com/)

S'mores is a WordPress starter theme based on [HTML5 Boilerplate](http://html5boilerplate.com/) & [Foundation](http://foundation.zurb.com) that will help the FIWI Creative Team (and others) create better Wordpress themes.

S'mores is an on-going project and an ever evolving repository. As our systems and processees change, so will S'mores.

## Features

* [Grunt](http://gruntjs.com) for compiling Sass to CSS, checking for JS errors, live reloading, concatenating and minifying files, optimizing PNGs and JPEGs, versioning assets, and generating lean Modernizr builds
* [Bower](http://bower.io/) for front-end package management
* [HTML5 Boilerplate](http://html5boilerplate.com/)
  * We use a little older version of HTML5 Boilerplate. We still like Paul Irish's IE version detection. Hey, in IE's case, browser detection _is_ feature detection. 
  * The latest [jQuery](http://jquery.com/) via Google CDN, with a local fallback (Bower)
  * The latest [Modernizr](http://modernizr.com/) build for feature detection, with lean builds with Grunt
  * An optimized Google Analytics snippet
* [Foundation 5](http://foundation.zurb.com)
* Organized file and asset structure

## Installation

1. Clone the git repo - `git clone https://github.com/findsomewinmore/smores.git`
2. Rename the directory to the name of your theme or website.
3. Remove the .git directory (This will preven you from commiting your personal project to the S'mores repositiory)
4. Initialize a new Git repo with `git init`

## Development

S'mores uses [Grunt](http://gruntjs.com/) for compiling Sass to CSS, checking for JS errors, live reloading, concatenating and minifying files, optimizing PNGs and JPEGs, versioning assets, and generating lean Modernizr builds.


### Install Grunt

**Unfamiliar with npm? Don't have node installed?** [Download and install node.js](http://nodejs.org/download/) before proceeding.

From the command line:

1. Install `grunt-cli` globally with `npm install -g grunt-cli`.
2. Navigate to the theme directory, then run `npm install`. npm will look at `package.json` and automatically install the necessary dependencies. It will automatically run `bower install`, which installs front-end packages defined in `bower.json`. 

When completed, you'll be able to see a Foundation 5 sample page by viewing _site.html in your browser. 

### Available Grunt commands

* `grunt` — Run all tasks: compile Sass to CSS, concatenate and validate JS, optimize images, build lean Modernizr file, etc.
* `grunt watch` — Run appropriate task when a file is changed.

###File Structure (See file comments for futher documentation; files vary depending on branch)
 * assets
	* bower_components (This is where bower stores our front end dependencies; do not source control)
	* css (Compiled, minified Sass)
		* ie-[version].css (IE only stylesheet)
		* styles.min.css (Sass compiles to here)
	* fonts (3rd part font files not available as webfonts)
	* img 
		* favicons (All favicons, tile icons, and homescreen icons are stored here)
		* src (Store uncompressed images and photos here, they will be optimized and saved in assets/img/)
	* js (Source and compiled Javascript. Source Javascript files begine with an underscore. Ex: \_main.js)
		* \_main.js (Main js file with DOM based routing)
		* scripts.min.js (\_main.js and other plugins compile to this)
	* scss (Source Sass files)
		* desktop (Desktop sized Sass files go here)
			* \_header.scss
			* \_main.scss
			* \_footer_scss
		* tablet (Desktop sized Sass files go here)
			 * \_header.scss
			* \_main.scss
			* \_footer_scss
		* Layout (Mobile first layout goes here)
			* \_header.scss
			* \_main.scss
			* \_footer_scss
		* \_animate.scss 
		* \_minins.scss
		* \_normalize.scss
		* \_typography.scss
		* \_variables.scss
		* style.scss
* lib (This is where we put all the functions included in functions.php)
	* init.php (Initialization stuff like theme support and sidebars)
	* nav.php (Custom nav walker for Top Bar and examples)
	* scripts.php (Enqueue scripts and stylesheets)
* node_modules (This is where grunt and its dependecies are stored; Do not version control)
* .bowerrc (Bower config file, we change the default install directory)
* .editorconfig (This ensures our entire team uses the same tabs and charset)
* .gitignore (Tell git to ignore bower_components, node_modules, and .DS_Store)
* .jshintrc (JS Hint config)
* Gruntfile.js (Grunt task declarations)
* package.json (Project package and dependencies list)
* bower.json (Project Bower dependencies)
* ...
* Wordpress theme files

# Credits

![Findsome & Winmore](http://findsomewinmore.com/wp-content/themes/fiwi/images/logo.png)

S'mores is maintained and funded by [Findsome & Winmore](http://findsomewinmore.com). This open source project is brought to you by dozens of other open source projects. We like to give credit to those that we have borrowed from. If you find a code snippet we forgot to credit, please submit a pull request for a README.md update.


# License

S'mores is Copyright © 2014 Findsome & Winmore. It is free software, and may be redistributed under the terms specified in the [LICENSE](LICENSE.md) file.
