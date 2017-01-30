## Welcome!

If you want this to run locally you'll need to create a local config file in config/config.local.php with the correct
 API settings. You'll also need to use docker-compose up to create the docker containers required (nginx/php-fpm). On
  top of that you'll want to run: composer install in the mount/ directory to ensure all the dependencies are there.

Due to time constraints I was unable to add any proper security to this interface. I did get this done in a few hours!

See below for more info on docker:

The Docker setup for PHP applications using PHP7-FPM and Nginx described in http://geekyplatypus.com/dockerise-your-php-application-with-nginx-and-php7-fpm

## Instructions
1. Checkout the repository
* ~~Create a record in your `hosts` file to point `php-docker.local` to your Docker environment~~
* Run `docker-compose up`
* ~~Navigate to php-docker.local:8080 in a browser~~
* Navigate to localhost:8080

That's it! You have your local PHP setup using Docker

*Example of activated PHP logging* - https://github.com/mikechernev/dockerised-php/tree/feature/log-to-stdout