# What is Kick

Kick is a project to start a site with some features using Codeigniter, HMVC, IonAuth, Composer, Bower, etc.


## Include

* [CodeIgniter](https://github.com/EllisLab/CodeIgniter) 3.0.0
* [Modular Extensions - HMVC](https://bitbucket.org/wiredesignz/codeigniter-modular-extensions-hmvc) 5.4
* [Ion Auth](https://github.com/benedmunds/CodeIgniter-Ion-Auth) 2.6.0

## Use theme

* Site: https://github.com/IronSummitMedia/startbootstrap-modern-business
* Admin: https://github.com/IronSummitMedia/startbootstrap-sb-admin-2

## Install

### 1 Step
#### Opção 1: Git Clone

	git clone https://github.com/marcelod/kick.git novo_site

#### Opção 2: Download repository

    https://github.com/marcelod/kick/archive/master.zip

### 2 Step


Create file [application/database.php](https://raw.githubusercontent.com/bcit-ci/CodeIgniter/develop/application/config/database.php"File application/database.php") and configure

	$db['default']['username'] = 'user';
	$db['default']['password'] = 'password';
	$db['default']['database'] = 'database';

### 3 Step

Create database and run assets/uploads/file.sql

## Access

	* login: admin@admin.com
	* password: password

## License

Please see the `license
agreement (https://github.com/marcelod/kick/blob/master/LICENSE)`_.