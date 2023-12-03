<?php

namespace App\Models;

/**
 * Modelo de dados dos hóspedes.
 * @package App\Model
 * @author Ricael V. Chiquetti <ricaelchiquetti28@gmail.com>
 */
class Hospede extends ModelBase {

    /** @var int */
    private string $id;

    /** @var string */
    private string $nome;

    /** @var string */
    private string $documento;

    /** @var string */
    private ?string $telefone;

    /**
     * Construtor da classe Hospede.
     * @param int $id
     * @param string $nome
     * @param string $documento
     * @param string|null $telefone
     */
    public function __construct(int $id = 0, string $nome = '', string $documento = '', ?string $telefone = null) {
        $this->setId($id)
            ->setNome($nome)
            ->setDocumento($documento)
            ->setTelefone($telefone);
    }

    /**
     * Retorna o ID do hóspede.
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * Retorna o nome do hóspede.
     * @return string
     */
    public function getNome(): string {
        return $this->nome;
    }

    /**
     * Retorna o documento do hóspede.
     * @return string
     */
    public function getDocumento(): string {
        return $this->documento;
    }

    /**
     * Retorna o telefone do hóspede.
     * @return string|null
     */
    public function getTelefone(): ?string {
        return $this->telefone;
    }

    /**
     * Define o ID do hóspede.
     * @param int $id
     * @return Hospede
     */
    public function setId(int $id): Hospede {
        $this->id = $id;
        return $this;
    }

    /**
     * Define o nome do hóspede.
     * @param string $nome
     * @return Hospede
     */
    public function setNome(string $nome): Hospede {
        $this->nome = $nome;
        return $this;
    }

    /**
     * Define o documento do hóspede.
     * @param string $documento
     * @return Hospede
     */
    public function setDocumento(string $documento): Hospede {
        $this->documento = $documento;
        return $this;
    }

    /**
     * Define o telefone do hóspede.
     * @param string|null $telefone
     * @return Hospede
     */
    public function setTelefone(?string $telefone): Hospede {
        $this->telefone = $telefone;
        return $this;
    }
}
