# LOGAZIN

## Environment
- Laravel
- Nuxt.js
- Local: Docker, Docker Compose
- Deploy: AWS
    - Lambda runtime: Node.js 12.x
    - CloudFront
    - S3
    - EC2

## Development
### Build & Up
```bash
$ docker-compose build
$ docker-compose up
```

### Initial setting for Laravel
Composer
```bash
$ docker-compose run --rm phpcli composer install
```

Generate app key
```bash
$ docker-compose run --rm phpcli php artisan key:generate
```

Migrate
```bash
$ docker-compose run --rm phpcli php artisan migrate
```

Set up laravel passport
```bash
$ docker-compose run --rm phpcli php artisan passport:install
```

Storage Permission
```bash
$ chmod -R 777 ./laravel/storage/
```

You can start server side development with Laravel !!

---

### Initial setting for Nuxt
set up .env.development
```bash
BASE_API_URL_CLIENT=
BASE_API_URL_SERVER=
```

yarn install
```bash
$ docker-compose run --rm yarn install
```

start nuxt server with hot loading
```bash
$ docker-compose run --rm yarn dev
```

## Deploy

### Deploy Laravel
TODO: how to set up aws.
TODO: deploy with ci.

set up AWS environment.  
I use following services in aws.
- EC2 (start with docker-compose)
- ALB
- ACM
- Route53

### Deploy Nuxt
configure aws cli.
```bash
$ aws configure
```

set up .env.production.
```bash
BASE_API_URL_CLIENT="api_url"
BASE_API_URL_SERVER="api_url"

S3_BUCKET_NAME="s3_bucket_name"
CLOUDFRONT_ID="cloudfront_id"

PASSPORT_PASSWORD_GRANT_CLIENT_ID="client_id created by laravel passport"
PASSPORT_PASSWORD_GRANT_CLIENT_SECRET="client_secret created by laravel passport"
```

Need your aws credential to deploy on aws.
(TODO: use docker)
(TODO: deploy with CI)
```bash
$ yarn deploy
```


