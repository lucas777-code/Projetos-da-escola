<?php
    namespace Models;

use Interfaces\Localvel;
use interfaces\Locavel;
    class Moto extends Veiculo implements Localvel {
        public function calcularAluguel(int $dias): float
        {
            return $dias * DIARIA_MOTO;
        }
 
        public function alugar(): string
        {
            if ($this->disponivel) {
                $this->disponivel = false;
                return "Moto '{$this->modelo}' alugada com sucesso!";
            } 
            return "Moto '{$this->modelo}' não disponível para aluguel.";
        }
 
        public function devolver(): string
        {
            if (!$this->disponivel) {
                $this->disponivel = true;
                return "Moto '{$this->modelo}' devolvida com sucesso!";
            } 
            return "Moto '{$this->modelo}' já está disponível.";
        }
    }


?>