# [Bedrock](https://github.com/gwa/bedrock-multisite-skeleton/)
[![Build Status](https://travis-ci.org/gwa/bedrock-multisite-skeleton.svg)](https://travis-ci.org/gwa/bedrock-multisite-skeleton)

Bedrock is a modern WordPress stack that helps you get started with the best development tools and project structure.

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

Use [bedrock-ansible](https://github.com/roots/bedrock-ansible) for additional features:

* Easy development environments with [Vagrant](http://www.vagrantup.com/)
* Easy server provisioning with [Ansible](http://www.ansible.com/) (Ubuntu 14.04, PHP 5.6 or HHVM, MariaDB)
* One-command deploys

## Requirements

* PHP >= 5.4

## Installation

1. Clone the git repo - `git clone https://github.com/gwa/bedrock-multisite-skeleton.git`
2. Run `composer install`
3. Copy `.env.example` to `.env` and update environment variables:
  * `DB_NAME` - Database name
  * `DB_USER` - Database user
  * `DB_PASSWORD` - Database password
  * `DB_HOST` - Database host
  * `WP_ENV` - Set to environment (`development`, `staging`, `production`)
  * `WP_HOME` - Full URL to WordPress home (http://example.com)
  * `WP_SITEURL` - Full URL to WordPress including subdirectory (http://example.com/wp)
4. Access WP admin at `http://example.com/wp/wp-admin`

## Deploys

Any other deployment method can be used as well with one requirement:

`composer install` must be run as part of the deploy process.

## Documentation

* [Folder structure]()
* [Configuration files](https://github.com/roots/bedrock/wiki/Configuration-files)
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
