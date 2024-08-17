# Laravel API

## Requirements

- Docker
- API Client (preferably) or curl

## Install and run instructions
1. Project is built using Laravel Sail. First time you will need to run:
```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php83-composer:latest \
    composer install --ignore-platform-reqs
```
in order to install composer dependencies without having php and composer on your local machine.
2. Create .env by running `cp .env.example .env`
3. Run Sail docker containers with `sail up -d`
4. Generate app key `sail art key:generate` 
5. Run migrations with `sail art migrate`
> If you do not have sail alias you will need to run sail as `./vendor/bin/sail` or to add sail alias first.

## How to test API endpoint
1. First run the project using `sail up -d`
2. Test the endpoint:
```curl
curl --request POST \
  --url http://localhost/api/submit \
  --header 'Accept: application/json' \
  --header 'Content-Type: application/json' \
  --data '{
  "name": "John Doe",
  "email": "john.doe@example.com",
  "message": "This is a test message."
  }'
```
> For convenience, you can use one of the popular API clients like Postman or Insomnia.
3. You can run PHP Unit tests by running `sail art test`
