````
# Projeto de Cadastro de Vendas

Este projeto é um sistema web para cadastro de vendas, desenvolvido com uma arquitetura desacoplada, utilizando Laravel para o backend e Vue.js para o frontend. Todo o ambiente de desenvolvimento é orquestrado com Docker e Docker Compose.

## Pré-requisitos

Antes de começar, garanta que você tenha os seguintes softwares instalados em sua máquina:

  * Docker
  * Docker Compose
  * Make (opcional, mas recomendado para usar os comandos de atalho)

## Instalação e Execução

Siga os passos abaixo para configurar e executar o ambiente de desenvolvimento.

1.  **Copiar e configurar o arquivo de ambiente do backend:**
    Navegue até a pasta `backend`, copie o arquivo `.env.example` e renomeie a cópia para `.env`.

2.  **Configurar o `.env` do backend:**
    Dentro do arquivo `.env`, ajuste as variáveis de conexão com o banco de dados para que correspondam ao serviço `mysql` do Docker Compose:

    ```env
    DB_CONNECTION=mysql
    DB_HOST=mysql
    DB_PORT=3306
    DB_DATABASE=cadastro_vendas
    DB_USERNAME=root
    DB_PASSWORD=root
    ```

3.  **Definir usuário padrão:**
    Ainda no arquivo `.env`, certifique-se de definir as credenciais para o usuário padrão que será criado.

    ```env
    DEFAULT_USER_EMAIL=seu-email@exemplo.com
    DEFAULT_USER_PASSWORD=sua-senha-secreta
    ```

4.  **Subir os contêineres:**
    Volte para a raiz do projeto e execute o comando para construir as imagens e iniciar os serviços.

    ```bash
    make up
    ```

5.  **Instalar dependências do Composer:**
    Execute o comando para instalar as dependências do PHP para o backend.

    ```bash
    make composer-install
    ```

6.  **Instalar dependências do NPM:**
    Execute o comando para instalar as dependências do JavaScript para o frontend.

    ```bash
    make npm-install
    ```

7.  **Executar as migrações do banco de dados:**
    Este comando irá criar as tabelas necessárias no banco de dados.

    ```bash
    make migration-up-all
    ```

Após esses passos, a aplicação estará pronta para uso.

## Acesso aos Serviços

  * **Frontend (Vue.js):** `http://localhost:5173`
  * **Backend API (via Nginx):** `http://localhost:8080`
  * **MailHog (captura de e-mails):** `http://localhost:8025`
  * **Banco de Dados (acesso externo):** Host `127.0.0.1`, Porta `3307`

## Comandos Disponíveis (Makefile)

Os seguintes comandos estão disponíveis para gerenciar o ambiente.

### Docker

  * `make up`: Inicia todos os contêineres em modo detached.
  * `make down`: Para e remove os contêineres, redes e volumes.
  * `make build`: Reconstrói as imagens dos serviços sem usar o cache.
  * `make restart`: Reinicia todos os serviços.

### Backend (Laravel)

  * `make composer-install`: Instala as dependências do Composer.
  * `make migration-up-all`: Executa todas as migrações do banco de dados.
  * `make db-seed`: Popula o banco de dados com os dados iniciais (seeders).

### Frontend (Vue.js)

  * `make npm-install`: Instala as dependências do NPM.
  * `make npm-dev`: Executa o servidor de desenvolvimento do frontend.
````
