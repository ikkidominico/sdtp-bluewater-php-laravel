# Bluewater

Bluewater project, developed with PHP and Laravel as admission exam at SDTP Foundation.

## Installation

First of all, Bluewater requires these following dependencies:
- [Docker](https://www.docker.com/)
- [Docker Compose](https://docs.docker.com/compose/)

And you can install them following these tutorials from Docker documentations:
- [Docker Install](https://docs.docker.com/get-docker/)
- [Docker Compose Install](https://docs.docker.com/compose/install/)

After install and configure the dependencies, check that you are in your home directory, clone the Bluewater repository and move into it:

```sh
cd ~
git clone https://github.com/ikkidominico/sdtp-bluewater-php-laravel.git
cd ~/sdtp-bluewater-php-laravel
```

Next, use Docker’s composer image to mount the directories that you will need for your Bluewater project, avoiding the overhead of installing Composer globally and set some permissions on the project directory:

```sh
docker run --rm -v $(pwd):/app composer install
sudo chown -R $USER:$USER ~/sdtp-bluewater-php-laravel
```

With your application code in place, now you can move on to configure the Bluewater application.

## Configuration

### Environment

Initially, create the .env file copying from the .env.example:

```sh
cp .env.example .env
```

Inside .env file, change these following properties to correctly connect with database:

```sh
DB_CONNECTION=pgsql
DB_HOST=database
DB_PORT=5432
DB_DATABASE=bluewater
DB_USERNAME=bluewater
DB_PASSWORD=bluewater
```

### Boot

To start the Bluewater application, run the Docker Compose with the following command: 

```sh
docker-compose up -d
```

The following command will generate a key and copy it to your .env file:

```sh
docker-compose exec app php artisan key:generate
```

You now have the environment settings required to run your application. To cache these settings into a file, run:

```sh
docker-compose exec app php artisan config:cache
```

### Migration and Seed

First, test the connection with database running the Laravel artisan migrate command, which creates a migrations table in the database from inside the container:

```sh
docker-compose exec app php artisan migrate
```

Once the migration is complete, you can run a command to seed the database with fake informations:

```sh
docker-compose exec app php artisan db:seed
```

After, you can run a query to check if you are properly connected to the database using the tinker command:

```sh
docker-compose exec app php artisan tinker
```

And getting the data that you just migrated:

```sh
>>> \DB::table('migrations')->get();
```
