<?php
namespace models;

// Classe abstrata para todos os tipos de veiculos
 abstract class veiculo {
    protected string $modelo;
    protected string $placa;
    protected bool $disponivel;

    public function __construct(string $modelo, string $placa){
        $this -> modelo = $modelo;
        $this -> placa = $modelo;
        $this -> disponivel = true;
    }

    // Função para calculo de aluguel
    abstract public function calcularAluguel(int $dias) : float;

    public function isDisponivel():bool{
        return $this->disponivel;
    }
    public function getModelo(): string{
        return $this->modelo;
    }
    public function getPlaca(): string{
        return $this->placa;
    }
    public function setDisponivel(bool $disponivel) :void{
        $this ->disponivel = $disponivel;
    }
 }