# Laravel Test Project Foundarium

## Installation

Clone project `
```bash
  git clone https://github.com/liana13/task_back_end

  cd task_back_end
```
Install dependencies `
```bash
  composer update && composer install
```

## Configuration

```bash
cp .env.example .env
```
- create database db_vehicles

config .env

Run Migrations and Seeds `
```bash
  php artisan migrate:fresh --seed
```

Run test `
 ```bash
    php artisan test
 ```

Api documentation
```http
 /api/documentation
```
