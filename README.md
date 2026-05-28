# Contact API

API REST para gerenciamento de contatos (pessoas), construída com **Symfony 7.4** e **Doctrine ORM**.

## Tecnologias

- PHP 8.2+
- Symfony 7.4
- Doctrine ORM 3.6
- Doctrine Migrations

## Endpoints

| Método | Rota           | Descrição                          |
|--------|----------------|------------------------------------|
| GET    | /person        | Lista contatos (filtros opcionais) |
| GET    | /person/{id}   | Busca contato por ID               |
| POST   | /person        | Cria novo contato                  |
| PUT    | /person/{id}   | Atualiza contato                   |
| DELETE | /person/{id}   | Remove contato                     |


## Como rodar o Projeto

```bash
# Instalar dependências
composer install

# Configurar variáveis de ambiente
cp .env .env.local
# Edite .env.local com suas credenciais de banco de dados

# Executar migrations
php bin/console doctrine:migrations:migrate

# Iniciar servidor de desenvolvimento
symfony server:start
```

## Estrutura do Projeto

```
src/
├── Controller/    # Controllers da API
├── DTO/           # Objetos de transferência de dados
├── Entity/        # Entidades do Doctrine
├── EventListener/ # Listeners de eventos
├── Exception/     # Exceções customizadas
├── Repository/    # Repositórios do Doctrine
└── Service/       # Camada de serviço (regras de negócio)
```
