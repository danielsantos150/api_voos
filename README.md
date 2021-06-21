<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## Documentação API em Laravel

Essa é uma API responsável por realizar o agrupamento de voos obtidos por uma outra API com base nas seguintes regras:

* Deve-se gerar grupos com uma ou mais opções de ida e volta;
* Dentro de um mesmo grupo não podem ter voos de tarifas diferentes;
* Ao formar um grupo é necessário criar um identificador único;
* Todo grupo deve ter um preço total;

### Bibliotecas utilizadas/compatíveis com a aplicação:

    - "php": 7.3|8.0,
    - "laravel/framework": 8.40,
    - "laravel/sanctum": 2.11

Abaixo segue o passo a passo para executar o projeto e realizar os testes

### Passo a Passo

- Realizar o download do repositório
- Abrir o CMD no diretório root do projeto e executar "composer update"
- Executar comando para criar o .env e "application key" no .env "cp .env.example .env" e em seguida "php artisan key:generate"
- Atualizar as informações do arquivo .env com a sua conexão de banco de dados
- Executar os migrations para o sistema criar a base de dados "php artisan migrate"
- Iniciar o ambiente de desenvolvimento do laravel "php artisan serve"


### Rotas e Funcionalidades

- Documentação no Postman:
        [Clique aqui para visualizar a documentação da API](https://documenter.getpostman.com/view/9534004/Tzeah5gb).
- Resumo das funcionalidades:
    - Autenticação da API
    - Busca dos Voos
    - Agrupamento dos Voos
