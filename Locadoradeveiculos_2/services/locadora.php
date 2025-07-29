<?php
    namespace Services;
    use models\{Veiculo, Carro, Moto};

    // classe para gerenciar a locadora
    class Locadora {
        private array $veiculos = [];

        // método construtor
        public function __construct() {
            $this->carregarVeiculos();
        }

        private function carregarVeiculos(): void {
            // verifica se o arquivo existe
            if (file_exists(ARQUIVO_JSON)) {
                // lê o conteudo e decodifica o JSON para o array
                $dados = json_decode(file_get_contents(ARQUIVO_JSON), true);
                foreach ($dados as $dado){

                    if($dado['tipo']=== 'Carro'){
                        $veiculo = new Carro($dado['modelo'], $dado['placa']);
                    }else{
                        $veiculo = new Moto($dado['modelo'], $dado['placa']);
                    }
                    $veiculo->setDisponivel($dado['disponivel']);

                    $this->veiculos[] = $veiculo;
                }
            } 
        }
        // salvar os veiculos
        private function salvarVeiculos(): void {
            $dados = [];

            foreach($this->veiculos as $veiculo){
                $dados[] = [
                    'tipo' => ($veiculo instanceof Carro) ? 'Carro' : 'Moto',
                    'modelo' => $veiculo->getModelo(),
                    'placa' => $veiculo->getPlaca(),
                    'disponivel' => $veiculo->isDisponivel()
                ];

                $dir = dirname(ARQUIVO_JSON);
                // verifica se o diretório existe
                if (!is_dir($dir)) {
                    // cria o diretório se não existir
                    mkdir($dir, 0777, true);
                }
            }
            // salva o array de veículos no arquivo JSON
            file_put_contents(ARQUIVO_JSON, json_encode($dados, JSON_PRETTY_PRINT));
        }

        // método para adicionar um veículo
        public function adicionarVeiculo(Veiculo $veiculo): void {
            $this->veiculos[] = $veiculo;
            $this->salvarVeiculos();
        }

        // remover veiculo
        public function deletarVeiculo(string $modelo, string $placa): string{
            foreach ($this->veiculos as $key => $veiculo) {
                // verifica se o modelo e a placa do veículo correspondem
                if ($veiculo->getModelo() === $modelo && $veiculo->getPlaca() === $placa){
                    // remove o veículo do array
                    unset($this->veiculos[$key]);

                    // reorganizar os indices
                    $this->veiculos = array_values($this->veiculos);

                    // salvar o novo stado
                    $this->salvarVeiculos();
                    return "Veículo '{$modelo}' removido com sucesso!";
                }
            }
            return "Veículo não encontrado!";
        }
        
        // Alugar veiculo por n dias
        public function alugarVeiculo(string $placa, int $dias = 1): string{
            // percorre a lista de veiculos
            foreach ($this->veiculos as $veiculo) {
                if ($veiculo->getPlaca() === $placa && $veiculo->isDisponivel()) {

                    // calcular valor do aluguel
                    $valorAluguel = $veiculo->calcularAluguel($dias);
                    // Marcar como alugado
                    $mensagem = $veiculo->alugar();
                    $this->salvarVeiculos();
                    return $mensagem . "Valor do aluguel: R$" . number_format($valorAluguel, 2, ',', '.');
                }
            }
            return "Veiculo não disponivel"; // veículo não encontrado ou não disponível
        }

        // devolver veiculo
        public function devolverVeiculo(string $placa) :string{

            // percorrer a lista
            foreach ($this->veiculos as $veiculo) {
                if ($veiculo->getPlaca() === $placa && !$veiculo->isDisponivel()) {

                    // disponibilizar o veiculo
                    $mensagem = $veiculo->devolver();
                    $this->salvarVeiculos();
                    return $mensagem;
                }
            }
            return "Veiculo ja disponivel ou não encontrado.";
        }

        // retornar a lista de veiculos
        public function listarVeiculos(): array {
            return $this->veiculos;
        }

        // calcular a previsão do valor
        public function calcularPrevisaoAluguel(string $tipo, int $dias): float {

            if ($tipo === 'Carro') {
                    return (new Carro('','')) ->calcularAluguel($dias);
                }
            return (new Moto('','')) ->calcularAluguel($dias); // veículo não encontrado
        }
    }
?>