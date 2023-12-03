# Projeto de Controle de Check-in e Hóspedes

Este projeto consiste em um sistema de controle de check-ins e hóspedes para um hotel. Ele oferece funcionalidades para criar, atualizar, listar e excluir check-ins e hóspedes.

## Pré-requisitos

- PHP >= 8.0
- Composer instalado para gerenciamento de dependências

## Instalação

1. **Clonando o repositório:**
   ```bash
   git clone https://github.com/ricaelchiquetti/Controle-de-Checkin-e-Hospedes

1. **Instalando as dependências:**   
   ```bash
   composer install
Certifique-se de ter o Composer instalado no seu sistema. Se não tiver, você pode obtê-lo em getcomposer.org.

## Configuração do banco de dados

1. **Credenciais do Banco de Dados:**
   - Preencha as credenciais do banco de dados no arquivo `.env`.
   - Certifique-se de ter um banco de dados criado para o projeto.

2. **Migrações do Banco de Dados:**
   - Execute as migrações para criar as tabelas necessárias:
     ```bash
     php migration.php
     ```

## Estrutura do Projeto

- `/app`: Contém os controllers e modelos do projeto.
- `/vendor`: Dependências gerenciadas pelo Composer.
- `migration.php`: Arquivo para execução de migrações do banco de dados.
- `composer.json`: Arquivo de configuração do Composer.

## Uso

### Exemplo de Uso

Um exemplo básico de como usar o sistema:

```php
// Exemplo de código