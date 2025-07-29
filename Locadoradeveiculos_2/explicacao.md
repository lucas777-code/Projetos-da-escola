# Funcionamento do Sistema de Locadora de Veiculos com PHP e Bootstrap

Este documento descreve o funcionamento do sistema de locadora de veiculos desenvolvido em php, utilizando o Bootstrap para interface, com autenticação dos usuarios, gerenciamento de veiculos e persistência de dados em arquivos JSON. O foco pricipal é explicar o funcionamento geral do sistema, com ênfase especial nos perfis de acesso.

## 1. Visão Geral do Sistema 

O sistema de locadora de veiculos é uma aplicação web que permite:
- Autenticação de usuário com dois perfis: **admin** (administrador) e **usuario**
- Gerenciamento de veiculos: cadastro, aluguel, devolução e exclusão;
- Calculo de previsão de aluguel: com base no tipo de veículo (carro ou moto) e numero de dias;
- interface responsiva.

Os dados são armazenados em dois arquivos JSON:
- `usuario.json`: username, senha criptografada e perfil
- `veiculos.json`: tipo, modelo, placa e status de disponibilidade

## 2.Estrutura do sistema
O sistema utiliza:
- **PHP**: para a lógica
- **Bootstrap**: para a estilização
- **Bootstrap icons**: para os ícones da interface
- **Composer**: para autoloading de classes
-**JSON**: para persistência de dados

### 2.1 Componentes principais
- **interfaces**: Define a interface `Locavel` para veiculos e utiliza os metodos `alugar()`, `devolver()` e  `isDisponivel()`´
- **Models**: classes `Veiculo` (abstrata), `Carro` e `Moto` para os veículos, com cálculo de aluguel baseado em diárias cojnstantes (`DIARIA_CARRO` e `DIARIA_MOTO`)
- **Services**: Classes `AUTH` (autenticação e gerenciamento de usuários) e `Locadora` (gerenciamento dos veículos)
- **Views**: Template principal ``template.php` para renderizar a interface e `login.php` para a autenticação
- **Controllers**: Lógica em `index.php` para processar requisições e carregar o template 