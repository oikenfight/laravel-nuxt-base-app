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
Migrate
```bash
$ docker-compose run --rm phpcli php artisan migrate
```

Set up laravel passport
```bash
$ docker-compose run --rm phpcli php artisan passport:install
```

You can start server side development with Laravel !!

###

### Initial setting for Nuxt
yarn install
```bash
$ docker-compose run --rm yarn install
```

start nuxt server with hot loading
```bash
$ docker-compose run --rm yarn dev
```

## Deploy
Need your aws credential to deploy on aws.
(TODO: use docker)
(TODO: use CI)
```bash
$ yarn sls
```


