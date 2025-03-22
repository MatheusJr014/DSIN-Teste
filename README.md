
<h1 align="center"> Teste DSIN </h1>


Projeto realizado como demanda de um teste para a Empresa DSIN.





## Requisitos

- Laravel 10 
- PHP 8.2.12
- Composer 2.7.7
- Pacotes Node 20.16.0 
- Vue Js 3  
- PostGreeSQL | PgAdmin 

## Passo a passo
```bash
git clone https://github.com/MatheusJr014/DSIN-Teste
```


## Instalação de dependencia Laravel

```bash
cd (pasta com o repositorio clonado)
```

```bash
cd DSIN-Teste\BackEnd\SalaoDeBelezaBackEnd 
```
### Na pasta do BackEnd dar o seguinte comando abaixo

```bash
composer install 
```


### Configurar o .env com as informações do banco local!!
```bash
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nome_do_banco
DB_USERNAME=usuario
DB_PASSWORD=senha

```
### Após isso será necessario criptografar uma key 

```bash
php artisan key:generate 
```
### Subir as migrations
```bash
php artisan migrate  
```
### Subir os seeders 
```bash
php artisan db:seed 
```

### Rodar o BackEnd Local 

```bash
php artisan serve 
```


## Instalação Vue Js 

## Usar 

```php
php artisan serve
```

> Primeiro Dar o Migrate Fresh 
> Depois Subir os Seeders 


## Credits

- [MatheusJr014](https://github.com/MatheusJr014) - Criador do projeto 