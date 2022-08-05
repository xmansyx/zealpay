
# Troylab Task



## Run Locally

Clone the project

```bash
  git clone https://github.com/xmansyx/troylab-task
```

Go to the project directory

```bash
  cd troylab-task
```

Install dependencies

```bash
  composer install
```

Start the server by laravel sail

```bash
  ./vendor/ben/sail up -d
```

Migrate and seed the database

```bash
  sail artisan migrate --seed
```
