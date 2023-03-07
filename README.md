# Projeto Laravel/Api/VueJs/Docker

## Criar imagem docker
### Na raiz do projeto execute o comando:
```
sudo docker build --build-arg user=${USER} --build-arg uid=$(id -u) -t php-v7.4 .
```

### Criar container:

```
sudo docker-compose up -d

```

### Executar migrations:

```
sudo docker exec -it laravel-sanctum-api-app php artisan migrate

```

### Executar seeder:

```
sudo docker exec -it laravel-sanctum-api-app php artisan db:seed
```

### Acessar porta:

```
http://localhost:8002/

```