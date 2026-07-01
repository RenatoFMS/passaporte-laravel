# Passaporte.io

## Sobre o Projeto

O **Passaporte.io** é uma aplicação web desenvolvida em **Laravel** para gerenciamento de eventos.

O sistema permite que **organizadores** cadastrem e gerenciem eventos, enquanto **participantes** podem visualizar os eventos disponíveis, realizar inscrições e acompanhar seus ingressos.

O projeto foi desenvolvido seguindo a arquitetura **MVC (Model-View-Controller)**, utilizando os principais recursos do framework Laravel, como autenticação, middleware, validações, migrations, relacionamentos entre tabelas e upload de arquivos.

---

# Funcionalidades

## Visitante

- Visualizar a vitrine de eventos
- Visualizar detalhes dos eventos
- Criar uma conta
- Realizar login

## Participante

- Visualizar eventos
- Inscrever-se em eventos
- Cancelar inscrição
- Visualizar seus ingressos

## Organizador

- Criar eventos
- Editar eventos
- Excluir eventos
- Gerenciar seus próprios eventos
- Fazer upload do banner do evento

---

# Tecnologias Utilizadas

- PHP 8.x
- Laravel 12
- MySQL
- Blade
- Tailwind CSS
- DaisyUI
- Eloquent ORM

---

# Estrutura do Projeto

```
app/
 ├── Http/
 │    ├── Controllers
 │    └── Middleware
 ├── Models

database/
 ├── migrations
 └── seeders

resources/
 └── views

routes/
 └── web.php

storage/
```

---

# Requisitos

Antes de executar o projeto é necessário possuir instalado:

- PHP 8.2 ou superior
- Composer
- MySQL
- Node.js
- NPM

---

# Instalação

Clone o repositório

```bash
git clone https://github.com/RenatoFMS/passaporte-laravel.git
```

Entre na pasta

```bash
cd passaporte-laravel
```

Instale as dependências

```bash
composer install
```

Instale as dependências do front-end

```bash
npm install
```

Copie o arquivo de ambiente

```bash
cp .env.example .env
```

Configure o banco de dados no arquivo **.env**

Exemplo:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=passaporte
DB_USERNAME=root
DB_PASSWORD=
```

Gere a chave da aplicação

```bash
php artisan key:generate
```

Execute as migrations

```bash
php artisan migrate
```

Caso existam seeders

```bash
php artisan db:seed
```

Ou

```bash
php artisan migrate --seed
```

Crie o link para armazenamento dos banners

```bash
php artisan storage:link
```

Compile os arquivos CSS e JavaScript

```bash
npm run dev
```

Inicie o servidor

```bash
php artisan serve
```

O sistema estará disponível em:

```
http://localhost:8000
```

---

# Banco de Dados

O projeto utiliza um banco de dados relacional composto pelas principais tabelas:

- users
- events
- categories
- event_user

Os relacionamentos são implementados utilizando o Eloquent ORM.

---

# Segurança

O sistema utiliza recursos nativos do Laravel para aumentar a segurança da aplicação:

- Autenticação
- Middleware
- CSRF Token
- Hash de senha
- Validação de formulários
- Upload seguro de arquivos

---

# Principais Recursos do Laravel Utilizados

- MVC
- Blade
- Middleware
- Authentication
- Validation
- Eloquent ORM
- Migrations
- Seeders
- Storage
- Route Groups

---

# Fluxo da Aplicação

Visitante

↓

Cadastro/Login

↓

Escolha do Perfil

↓

Participante
- Visualiza eventos
- Realiza inscrições
- Consulta ingressos

ou

Organizador
- Cria eventos
- Edita eventos
- Exclui eventos
- Gerencia seus eventos

---



Projeto desenvolvido para a disciplina de Desenvolvimento Web utilizando Laravel.
