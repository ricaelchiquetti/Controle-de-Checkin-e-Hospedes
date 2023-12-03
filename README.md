# Projeto Hotel

Este repositório contém um conjunto de classes relacionadas a um sistema de gestão de um hotel, incluindo modelos, controladores e serviços para lidar com informações de hóspedes, check-ins e outras funcionalidades.

## Estrutura do Projeto

O projeto está organizado em diversas classes para separação de responsabilidades:

### Models

- **Hospede.php**: Representa as informações dos hóspedes, incluindo nome, documento e telefone.
- **Checkin.php**: Representa as informações dos check-ins, incluindo datas de entrada e saída, informações do hóspede associado e detalhes do check-in.

### Controllers

- **HospedeController.php**: Controla as operações relacionadas aos hóspedes, como buscar, criar, atualizar e deletar informações.
- **CheckinController.php**: Controla as operações relacionadas aos check-ins, incluindo a manipulação das datas de entrada e saída.

### Services

- **ModelDataService.php**: Um serviço genérico para manipulação de dados dos modelos. Utilizado para executar operações de CRUD nos modelos Hospede e Checkin.

## Funcionalidades Principais

### Hospede

O modelo `Hospede` lida com informações básicas dos hóspedes do hotel, incluindo nome, documento e telefone. O `HospedeController` oferece funcionalidades para gerenciar essas informações, como criar, atualizar, buscar e deletar hóspedes.

### Checkin

O modelo `Checkin` está associado aos registros de entrada e saída dos hóspedes. O `CheckinController` permite manipular esses registros, incluindo a gestão das datas de entrada e saída.

## Uso

- Instruções sobre como usar as classes e métodos principais.
- Dependências necessárias para rodar o projeto.

## Licença

Este projeto está licenciado sob a [sua licença].

---