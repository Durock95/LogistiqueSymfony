<h1>LogistiqueSymfony</h1>

This is a fictional logistical management application based on Symfony.
It includes entities for suppliers, products, categories, commands, and users, with full CRUD interfaces and Docker support.

You'll find a base for logistical company to manage suppliers, entries, products, categories, commands, users, 
with relational entities, access and views controllers, formulars to create or modifiy data into the database.

Technologies

  - Symfony (PHP framework) to manage Model / View / Controller</li>
  - Docker (MySQL and phpMyAdmin)</li>
  - Twig (templating engine)</li>
  - Javascript (event listeners, FullCalendar</li>
  - CSS (basic styling)</li>


<h2>Installation (macOs):</h2>

<h2>1. Clone this project</h2>

```bash
https://github.com/Durock95/LogistiqueSymfony.git
```
<h2>2. Install necessary tools</h2>

Homebrew

```bash
/bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"
```
PHP

```bash
brew install php
php --version
```

Composer

```bash
brew install composer
composer --version
```
Symfony CLI

```bash
brew install symfony-cli/tap/symfony-cli
symfony -V
```

<h2>3. Run the project</h2>

Install dependencies

```bash
composer install
```
Configure `.env`

Modify `DATABASE_URL=`with:
```bash
 DATABASE_URL="mysql://root:root@127.0.0.1:3306/databaseName?serverVersion=9.2.0&charset=utf8mb4"
```

Run Docker (MySQL + phpMyAdmin)

Be sure that `compose.yaml` is configured with MySQL:
```bash
docker compose up -d
```

Create database

```bash
php bin/console doctrine:database:create
```
In phpMyAdmin (`http://localhost:8080`), change collation in `utf8mb4_unicode_ci` (it supports mappings such as expansions).

<h2>4. Launch Symfony server</h2>

```bash
symfony server:start
```

<h2>5. Other useful packages</h2>

- Twig : `composer require symfony/twig-bundle`<br>
- Twig Intl : `composer require twig/intl-extra`<br>
- MakerBundle : `composer require --dev symfony/maker-bundle`

<h3>Observations</h3>

Don't execute `symfony new ...`, this project is already initialised.<br>
The 404 message on `http://localhost:8000`is normal without controller by default.
