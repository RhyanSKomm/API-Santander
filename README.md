# Api Santander

Projeto para representar a API do banco Santander que será usada pelo Aplicativo Santander

## Desenvolvimento

1. Clone o repositorio
2. Iniciar o banco MySql na pasta `php-workspace` com o comando `./start`
3. Iniciar o servidor da api na pasta raiz do projeto `api-santander` com o comando `symfony serve`
4. Instalar as dependências com `composer install`
5. Criar o banco de dados do projeto com o comando `symfony console doctrine:database:crate`
6. Executar as migrations do projeto com o comando `symfony console doctrine:migrations:migrate`
7. O projeto estara acessivel em `http://127.0.0.1:8000/api`

## Conceitos

DTO  -> Data Transfer Object
    É um objeto de transferência entre os dados do banco e quem usa a sua API