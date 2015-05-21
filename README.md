Bedrock Multisite Skeleton
=========

A [WordPress Bedrock multisite](https://github.com/gwa/bedrock-multisite-skeleton) skeleton. This project is trying to simplify the way we're setting up a new WordPress project. [Don't repeat yourself](http://en.wikipedia.org/wiki/Don't_repeat_yourself).

#
[![Build Status](https://travis-ci.org/gwa/bedrock-multisite-skeleton.svg)](https://travis-ci.org/gwa/bedrock-multisite-skeleton)
[![License](https://img.shields.io/packagist/l/wordplate/wordplate.svg?style=flat)](https://packagist.org/packages/wordplate/wordplate)

Much of the philosophy behind Bedrock is inspired by the [Twelve-Factor App](http://12factor.net/) methodology including the [WordPress specific version](https://roots.io/twelve-factor-wordpress/).

## Features

* Dependency management with [Composer](http://getcomposer.org)
* Better folder structure
* Easy WordPress configuration with environment specific files
* Environment variables with [Dotenv](https://github.com/vlucas/phpdotenv)
* Whoops is a nice little library that helps you deal with errors and exceptions in a less painful way.
* Autoloader for mu-plugins (use regular plugins as mu-plugins)
* [Debug Bar](https://wordpress.org/plugins/debug-bar/) Adds a debug menu to the admin bar that shows query, cache, and other helpful debugging information.
* [Developer](https://wordpress.org/plugins/developer/) A plugin, which helps WordPress developers develop.
* [Stage Switcher] Detects all the enviroments in WordPress.
* [MultisiteDirectoryResolver](https://github.com/gwa/WpMultisiteDirectoryResolver) Adds filters that correct directory paths in a Wordpress multisite install with the WordPress installation in a custom subfolder.
* Koodimonni composer lang support 

## Plugins & Themes

We are using [WordPress Packagist](http://wpackagist.org/) for plugins. To add a plugin from the [WordPress Plugin Directory](https://wordpress.org/plugins/) add the to the required array in the [composer.json](composer.json) file. Specify them with `wpackagist-plugin` following by the plugin slug name. Example below.

```json
"wpackagist-plugin/plugin-name": "~1.0.1"
```

Please note that this also works with themes and WordPress multi-site plugins.

## Requirements

* PHP >= 5.4

## Installation

Install Bedrock Multisite by issuing the Composer `create-project` command in your terminal:

1. `composer create-project gwa/bedrock-multisite-skeleton`
2. Copy `.env.example` to `.env` and update environment variables:
  * `DB_NAME` - Database name
  * `DB_USER` - Database user
  * `DB_PASSWORD` - Database password
  * `DB_HOST` - Database host
  * `WP_ENV` - Set to environment (`development`, `staging`, `production`)
  * `WP_HOME` - Full URL to WordPress home (http://example.com)
  * `WP_SITEURL` - Full URL to WordPress including subdirectory (http://example.com/wp)
3. Access WP admin at `http://example.com/wp/wp-admin`

Read more about setting up `Bedrock Multisite` on our [installation documentation](https://github.com/gwa/bedrock-multisite-skeleton/wiki/Installation) page.

## Deploys

Any other deployment method can be used as well with one requirement:

`composer install` must be run as part of the deploy process.

## Documentation

* [Folder structure](https://github.com/gwa/bedrock-multisite-skeleton/wiki/Folder-structure)
* [Configuration files](https://github.com/gwa/bedrock-multisite-skeleton/wiki/Configuration-files)
* [Environment variables](https://github.com/roots/bedrock/wiki/Environment-variables)
* [Composer](https://github.com/roots/bedrock/wiki/Composer)
* [wp-cron](https://github.com/roots/bedrock/wiki/wp-cron)
* [mu-plugins autoloader](https://github.com/roots/bedrock/wiki/mu-plugins-autoloader)

## Contributing

Contributions are welcome from everyone. We have [contributing guidelines](CONTRIBUTING.md) to help you get started.

## Community

Keep track of development and community news.

* Participate on the [Roots Discourse](https://discourse.roots.io/)
* Follow [@rootswp on Twitter](https://twitter.com/rootswp)
* Read and subscribe to the [Roots Blog](https://roots.io/blog/)
* Subscribe to the [Roots Newsletter](https://roots.io/subscribe/)
