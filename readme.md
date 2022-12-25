# Projeto Lanchonete API


<img src="https://github.com/CLucasrodrigues22/grecia-burger/admin/db/grecia-burger.png" alt="Lanchonete Dashboard">

> Esse aplicação foi criada para gerenciamento de uma lanchonete (genérica) usando PHP(DAO) e Mysql no Backend em Curso.

### Funções da aplicação

O que essa aplicação faz?

- [x] Controle de estoque para Suprimentos de uma lanchonete com informativos (alertas) de quantidade;
- [x] Gerenciamento de clientes;
- [x] Niveis de Perfis (Administrativo, vendendor, Financeiro);
- [x] Graficos com informações em tempo real na dashboard;
- [x] Gerador de relatório de vendas (Por dia, semana e mês);

## 💻 Pré-requisitos

Para a instalação da aplicação, são necessário os seguintes requisitos:

* PHP versão 7 ou maior;
* Banco de dados MySQL;

## 🚀 Instalando a Lanchonete API

Para instalar a Lanchonete API, siga estas etapas:

- Clone o repositório em sua maquina local ou servidor;

- Execute o arquivo .sql localizado em bd/lanchonete.sql no banco de dados (Caso você queira utilizar outro Banco de dados ao inves do Mysql, apenas mude o diver em Classes/Conexao.php linha 11, e configure no php.ini);

- Inicialize o servidor, entre na pasta raiz da aplicação pelo terminal e digite:

```
php -S localhost:(porta de preferência)
```

- Agora acesse via browser o endereço da aplicação;

## ☕ Usando a Lanchonete API

Ao acessar a aplicação no Browser, a primeira tela será a de Login, por padrão, o login inicial é:

```
Email: admin@admin.com
Senha: 1234
```

Após acessar com o login acima, será possivel alterar a senha do login de admin e criar usuários com seus respectivos tipos de perfis!



[⬆ Voltar ao topo](#lanchonete-api)<br>
