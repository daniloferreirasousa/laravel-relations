## Setup Docker Laravel

### Passo a passo

Crie um novo projeto Laravel a partir do Composer
```sh
composer create-project --prefer-dist laravel/laravel nome-seu-projeto
```

Clone Repositório para dentro do seu Projeto Laravel criado recentemente
```sh
git clone https://github.com/daniloferreirasousa/docker.git ./
```

Crie o Arquivo .env
```sh
cp .env.example .env
```

Atualize as variáveis de ambiente do arquivo .env
```dosini
APP_NAME="Nome do seu Projeto"
APP_URL=http://localhost:8989
APP_USER=user  // não usar espaços em branco
APP_UID=1000  // recomendado

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=root

CACHE_DRIVER=redis
QUEUE_CONNECTION=redis
SESSION_DRIVER=redis

REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379
```

Crie a imagem do seu Container
```sh
docker-compose build --no-cache
```

Suba os containers do projeto
```sh
docker-compose up -d
```


Acessar o container
```sh
docker-compose exec app bash
```


Instalar as dependências do projeto
```sh
composer install
```

Atualizar as dependências caso hajam atualizações
```sh
composer update
```


Acesse o projeto
[http://localhost:8989](http://localhost:8989)