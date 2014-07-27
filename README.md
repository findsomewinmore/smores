# [FIWI Starter Kit](https://websolvers.springloops.io/project/102253)

[![Built with Grunt](https://cdn.gruntjs.com/builtwith.png)](http://gruntjs.com/)

FIWI Starter Kit is a WordPress starter theme based on [HTML5 Boilerplate](http://html5boilerplate.com/) & [Foundation](http://foundation.zurb.com) that will help the FIWI Creative Team (and others) create better Wordpress themes.

FIWI Starter Kit is an on-going project and an ever evolving repository. As out systems and processees change, so will FIWI Starter Kit.

## Features

* [Grunt](http://gruntjs.com) for compiling Sass to CSS, checking for JS errors, live reloading, concatenating and minifying files, optimizing PNGs and JPEGs, versioning assets, and generating lean Modernizr builds
* [Bower](http://bower.io/) for front-end package management
* [HTML5 Boilerplate](http://html5boilerplate.com/)
  * We use a little older version of HTML5 Boilerplate. We still like Paul Irish's IE version detection. Hey, in IE's case, browser detection, _is_ feature detection. 
  * The latest [jQuery](http://jquery.com/) via Google CDN, with a local fallback (Bower)
  * The latest [Modernizr](http://modernizr.com/) build for feature detection, with lean builds with Grunt
  * An optimized Google Analytics snippet
* [Foundation 5](http://foundation.zurb.com)
* Organized file and asset structure

### Feature Wish List
* Foundation Topbar Walker Menu (Coming Soon)
* Micro Format examples. 

## Installation

1. Clone the git repo - `git clone https://slsapp.com/git/websolvers/fiwistartertheme.git`
2. Rename the directory to the name of your theme or website.
3. Remove the .git directory (This will preven you from commiting your personal project to the FIWI Starter Kit repositiory)
4. Initialize a new Git repo with `git init`

## Theme development

FIWI Starter Kit uses [Grunt](http://gruntjs.com/) for compiling Sass to CSS, checking for JS errors, live reloading, concatenating and minifying files, optimizing PNGs and JPEGs, versioning assets, and generating lean Modernizr builds.


### Install Grunt

**Unfamiliar with npm? Don't have node installed?** [Download and install node.js](http://nodejs.org/download/) before proceeding.

From the command line:

1. Install `grunt-cli` globally with `npm install -g grunt-cli`.
2. Navigate to the theme directory, then run `npm install`. npm will look at `package.json` and automatically install the necessary dependencies. It will automatically run `bower install`, which installs front-end packages defined in `bower.json`. 

When completed, you'll be able to see a Foundation 5 sample page by viewing _site.html in your browser. 

### Available Grunt commands

* `grunt` — Run all tasks: compile Sass to CSS, concatenate and validate JS, optimize images, build lean Modernizr file, etc.
* `grunt watch` — Run appropriate task when a file is changed.