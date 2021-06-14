# EXAM PHP POO

## Requirements

### PHP

> php \>= 8.0

### Yaml

If you don't have yaml extension


Install pecl

```bash
sudo apt-get install php-pear
```

Then, install yaml extension

```bash
pecl install yaml
```

And add in your php.ini:

```ini
extension=yaml.so
```

## Installation

Download this repository

```bash
git clone https://github.com/parad0xe/exam-dfs-php_poo.git
```

Install framework core

```bash
composer run framework:core:install
```

Install dependencies

```bash
composer install
```

## Resources

Import the included sql file `exam_poo.sql`

```
Database authors:

user 1:
- email: demo@demo.com
- password: demo

user 2:
- email: demo2@demo2.com
- password: demo
```

> No use of SQL JOIN because the fetch mode used does not extend over several classes.

## Usage

Run server: `php -S localhost:3000`
