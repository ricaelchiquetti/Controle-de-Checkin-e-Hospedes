<?php

namespace App\Models;

/**
 * Modelo de dados dos hóspedes.
 * @package App\Model
 * @author Ricael V. Chiquetti <ricaelchiquetti28@gmail.com>
 */
class Checkin extends ModelBase {

    /** @var int */
    private int $id;

    /** @var Hospede */
    private Hospede $hospede;

    /** @var string */
    private string $dataEntrada;

    /** @var string */
    private string $dataSaida;

    /** @var boolean */
    private bool $adicionalVeiculo;

    /**
     * Construtor da classe CheckIn.
     * @param int $id
     * @param Hospede $hospede
     * @param string $dataEntrada 
     * @param string $dataSaida
     * @param boolean $adicionalVeiculo
     */
    public function __construct(int $id = 0, string $dataEntrada = '', string $dataSaida = '', bool $adicionalVeiculo = false) {
        $this->id = $id;
        $this->dataEntrada = $dataEntrada;
        $this->dataSaida = $dataSaida;
        $this->adicionalVeiculo = $adicionalVeiculo;
    }

    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): CheckIn {
        $this->id = $id;
        return $this;
    }

    public function getHospede(): Hospede {
        return $this->hospede ??= new Hospede();
    }

    public function setHospede(Hospede $hospede): CheckIn {
        $this->hospede = $hospede;
        return $this;
    }

    public function getDataEntrada(): string {
        return $this->dataEntrada;
    }

    public function setDataEntrada(string $dataEntrada): CheckIn {
        $this->dataEntrada = $dataEntrada;
        return $this;
    }

    public function getDataSaida(): string {
        return $this->dataSaida;
    }

    public function setDataSaida(string $dataSaida): CheckIn {
        $this->dataSaida = $dataSaida;
        return $this;
    }

    public function getAdicionalVeiculo(): bool {
        return $this->adicionalVeiculo;
    }

    public function setAdicionalVeiculo(bool $adicionalVeiculo): CheckIn {
        $this->adicionalVeiculo = $adicionalVeiculo;
        return $this;
    }
}
