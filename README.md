# LogistiqueSymfony

This is a fictional logistical management application based on Symfony.
It includes entities for suppliers, products, categories, commands, and users, with full CRUD interfaces and Docker support.

You'll find a base for logistical company to manage suppliers, entries, products, categories, commands, users, 
with relational entities, access and views controllers, formulars to create or modifiy data into the database.

### Technologies

  - Symfony (PHP framework) to manage Model / View / Controller</li>
  - Docker (MySQL and phpMyAdmin)</li>
  - Twig (templating engine)</li>
  - Javascript (event listeners, FullCalendar</li>
  - CSS (basic styling)</li>

<details>
<summary><h2>Installation macOs:</h2></summary>

### 1. Clone this project

```bash
https://github.com/Durock95/LogistiqueSymfony.git
```
### 2. Install necessary tools

#### Homebrew

```bash
/bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"
```
#### PHP

```bash
brew install php
php --version
```

#### Composer

```bash
brew install composer
composer --version
```
#### Symfony CLI

```bash
brew install symfony-cli/tap/symfony-cli
symfony -V
```
</details>
<details>
  <summary><h2>Installation Windows</h2></summary>
  
  ### 1. Clone this project

```bash
https://github.com/Durock95/LogistiqueSymfony.git
```
### 2. Install necessary tools

#### PHP

Download the PHP zip tree (CLI)
```bash
https://windows.php.net/download
```
Unzip it in an empty directory.
Add the directory path.
Dupplicate `php.ini-development` and rename it in `php.ini`.
In the `php.ini` file, activate extensions such as:<br>
- `extensions=pdo_mysql`
- `extension=zip`

Get the version:
```bash
php --version
```

#### Composer

Download the installer: `https://getcomposer.org/download`
Execute installer (with addition to the path).
Get the version:
```bash
composer --version
```

#### Symfony CLI

Download the zipped binary Symfony CLI (amd64) : `https://symfony.com/download`
Unzip it in an empty directory.
Add the directory path.
Get the version:
```bash
symfony -V
```
</details>

### 3. Run the project

#### Install dependencies

```bash
composer install
```
#### Configure `.env`

#### Modify `DATABASE_URL=`with:
```bash
 DATABASE_URL="mysql://root:root@127.0.0.1:3306/databaseName?serverVersion=9.2.0&charset=utf8mb4"
```

#### Run Docker (MySQL + phpMyAdmin)

Be sure that `compose.yaml` is configured with MySQL:
```bash
docker compose up -d
```

#### Create database

```bash
php bin/console doctrine:database:create
```
In phpMyAdmin (`http://localhost:8080`), change collation in `utf8mb4_unicode_ci` (it supports mappings such as expansions).

### 4. Launch Symfony server

```bash
symfony server:start
```

### 5. Other useful packages

- Twig : `composer require symfony/twig-bundle`<br>
- Twig Intl : `composer require twig/intl-extra`<br>
- MakerBundle : `composer require --dev symfony/maker-bundle`

<h3>Observations</h3>

Don't execute `symfony new ...`, this project is already initialised.<br>
The 404 message on `http://localhost:8000`is normal without controller by default.
