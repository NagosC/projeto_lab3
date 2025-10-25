# Projeto Lab - Agendador de Reuniões

## Descrição

Este é um projeto de faculdade para um agendador de reuniões simples. A aplicação permite que os usuários se registrem, façam login, agendem reuniões e convidem outros usuários para participar.

## Funcionalidades

- **Gerenciamento de Usuários:**
  - Registro e login de usuários.
  - Perfis de usuário com informações básicas (nome, e-mail).
- **Calendário e Reuniões:**
  - Calendário visual (visualização mensal como padrão).
  - Agendamento de novas reuniões com título, descrição, data e hora.
  - Visualização de detalhes da reunião.
  - Adicionar outros usuários registrados às reuniões, pesquisando por nome ou e-mail.
  - Notificações simples no aplicativo para convites de reunião.

## Tecnologias Utilizadas

- **Linguagem:** PHP (abordagem procedural simples dentro do MVC)
- **Banco de Dados:** MySQL (via XAMPP)
- **Estilo:** CSS minimalista para uma interface limpa e funcional.
- **Arquitetura:** MVC (Model-View-Controller)

## Instalação e Configuração

1.  **Clone o repositório:**
    ```bash
    git clone <URL_DO_REPOSITORIO>
    ```
2.  **Configure o banco de dados:**
    - Certifique-se de ter o XAMPP instalado e o MySQL em execução.
    - Renomeie o arquivo `config/database.php.example` para `config/database.php`.
    - Edite o arquivo `config/database.php` com suas credenciais do MySQL.
3.  **Execute o script de configuração:**
    - Abra seu navegador e acesse `http://localhost/projeto_lab/setup.php`.
    - Isso criará o banco de dados e as tabelas necessárias.
4.  **Acesse a aplicação:**
    - Abra seu navegador e acesse `http://localhost/projeto_lab/`.

## Estrutura de Arquivos

```
/
├── .htaccess
├── index.php
├── config/
│   └── database.php
├── controllers/
│   ├── MeetingController.php
│   └── UserController.php
├── models/
│   ├── Meeting.php
│   └── User.php
├── public/
│   └── css/
│       └── style.css
└── views/
    ├── pages/
    │   ├── dashboard.php
    │   ├── login.php
    │   └── register.php
    └── templates/
        ├── footer.php
        └── header.php
```
