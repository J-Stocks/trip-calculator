#General
- No additional Packages have been used.
- Scenarios A and B have been implemented.

# Set up
- Checkout the repo from GitHub: `git clone git@github.com:J-Stocks/trip-calculator.git`
- Install dependencies: `composer install`
- Create the .env file: `cp .env.example .env`
- Set up a database. MySQL is the default, but see the [docs](https://laravel.com/docs/5.8/database#configuration) if you intend to use an alternative.
- Add the connection details for the database to the .env file, all the properties prefixed with "DB_" are required.
- Seed the database: `php artisan migrate:fresh --seed`
- Run the tests: `vendor/bin/phpunit`