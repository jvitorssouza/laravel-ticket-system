## Sobre o Sistema

Sistema de Helpdesk Simples com controle de chamados por 
departamentos, empresas (filiais) e categorias de chamados como Redes, 
Hardware, Sistema, entre outros.

## Pré-Requisitos
1. Git 
2. Composer

## Como Instalar
1. Abra o terminal git na pasta desejada
2. Dê o git clone https://github.com/jvitorssouza/laravel-ticket-system.git
3. Entre na pasta do projeto, e instale as dependências do projeto com o comando "composer install"
4. Após instalado as dependências, copie o arquivo .env.example renomeando-o para .env
5. Execute o comando "php artisan key:generate" para gerar a Key do sistema.
6. Crie uma base de dados e insira suas informações de acesso como Usuário, Senha e Banco no arquivo .env
7. Execute o comando "php artisan migrate --seed" no terminal para criar as tabelas da base e inserir os registros iniciais
8. Execute o comando "php artisan serve" e acesse o sistema no seu browser a partir da url "http://localhost:8000"

## Acesso inicial ao sistema
Usuário: sysadmin
Senha:   admin
