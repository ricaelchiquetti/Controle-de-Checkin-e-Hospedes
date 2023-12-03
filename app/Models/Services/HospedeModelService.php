<?php

namespace App\Models\Services;

use App\Models\Hospede;

/**
 * Serviço de manipulação de dados relacionados aos Hóspedes.
 * @package App\Models\Services
 * @author Ricael V. Chiquetti <ricaelchiquetti28@gmail.com>
 * 
 * @method Hospede getModel()
 */
class HospedeModelService extends ModelDataService {

    /**
     * {@inheritDoc}
     */
    public function create(): bool {
        $nome = $this->getModel()->getNome();
        $documento = $this->getModel()->getDocumento();
        $telefone = $this->getModel()->getTelefone();

        $sql = "INSERT INTO hotel_db.hospedes (nome, documento, telefone) VALUES (?, ?, ?)";
        $params = [$nome, $documento, $telefone];

        return $this->executeQuery($sql, $params);
    }

    /**
     * {@inheritDoc}
     */
    public function update(): bool {
        $id = $this->getModel()->getId();
        $nome = $this->getModel()->getNome();
        $documento = $this->getModel()->getDocumento();
        $telefone = $this->getModel()->getTelefone();

        $sql = "UPDATE hotel_db.hospedes SET nome = ?, documento = ?, telefone = ? WHERE id = ?";
        $params = [$nome, $documento, $telefone, $id];

        return $this->executeQuery($sql, $params);
    }

    /**
     * {@inheritDoc}
     */
    public function delete(): bool {
        $id = $this->getModel()->getId();

        $sql = "DELETE FROM hotel_db.hospedes WHERE id = ?";
        $params = [$id];

        return $this->executeQuery($sql, $params);
    }

    /**
     * {@inheritDoc}
     */
    protected function getSelectQuery(array $conditions = []): string {
        $sql = "SELECT hospedes.id, hospedes.nome, hospedes.documento, hospedes.telefone,
                    ({$this->getSubTotalGasto()}) AS valor_total_gasto,
                    ({$this->getSubUltimaCheckin()}) as valor_ultima_hospedagem 
                    FROM hotel_db.hospedes
                    {$this->getJoinUltimoCheckin()}
                    {$this->getJoinCheckin()}";

        if (!empty($conditions)) {
            $condition = implode(" AND ", $conditions);
            $sql .= " WHERE $condition ";
        }

        $sql .= " 
        GROUP BY hospedes.id, hospedes.nome, hospedes.documento, hospedes.telefone";
        return $sql;
    }

    /**
     * Retorna o SubSelect do total gasto
     * @return string
     */
    private function getSubTotalGasto(): string {
        return 'COALESCE(SUM(CASE WHEN DAYOFWEEK(checkins.dataSaida) IN (2, 3, 4, 5, 6) 
                        THEN CASE WHEN TIME(checkins.dataSaida) > \'16:30:00\' THEN (DATEDIFF(checkins.dataSaida, checkins.dataEntrada) + 1) * 135
                                    ELSE DATEDIFF(checkins.dataSaida, checkins.dataEntrada) * 120
                            END
                    ELSE CASE WHEN TIME(checkins.dataSaida) > \'16:30:00\' THEN (DATEDIFF(checkins.dataSaida, checkins.dataEntrada) + 1) * 170
                            ELSE DATEDIFF(checkins.dataSaida, checkins.dataEntrada) * 150
                        END
                    END), 0)';
    }

    /**
     * Resorna o subSelect do Ultimo checkin
     * @return string
     */
    private function getSubUltimaCheckin(): string {
        return 'CASE WHEN DAYOFWEEK(ultimo_checkin.dataSaida) IN (2, 3, 4, 5, 6) 
                        THEN CASE WHEN TIME(ultimo_checkin.dataSaida) > \'16:30:00\' THEN (DATEDIFF(ultimo_checkin.dataSaida, ultimo_checkin.dataEntrada) + 1) * 135
                                ELSE DATEDIFF(ultimo_checkin.dataSaida, ultimo_checkin.dataEntrada) * 120
                            END
                        ELSE CASE WHEN TIME(ultimo_checkin.dataSaida) > \'16:30:00\' THEN (DATEDIFF(ultimo_checkin.dataSaida, ultimo_checkin.dataEntrada) + 1) * 170
                                ELSE DATEDIFF(ultimo_checkin.dataSaida, ultimo_checkin.dataEntrada) * 150
                            END
                    END';
    }

    /**
     * Retorna o join com o ultimo checkin
     * @return string
     */
    private function getJoinUltimoCheckin(): string {
        return 'LEFT JOIN (
                SELECT checkins1.id_hospede,
                        checkins1.dataEntrada,
                        checkins1.dataSaida
                    FROM checkins checkins1
                WHERE checkins1.dataEntrada = (SELECT MAX(checkins2.dataEntrada)
                                                    FROM checkins checkins2
                                                WHERE  checkins1.id_hospede = checkins2.id_hospede)
            ) ultimo_checkin ON hospedes.id = ultimo_checkin.id_hospede';
    }

    /**
     * Retorna o join com o Checkin
     * @return string
     */
    private function getJoinCheckin(): string {
        return 'LEFT JOIN checkins ON hospedes.id = checkins.id_hospede';
    }

    /**
     * {@inheritDoc}
     */
    protected function getConditionSql(): array {
        $conditions = [];
        $params = [];

        $id = $this->getModel()->getId();
        if ($id) {
            $conditions[] = "hospedes.id = ?";
            $params[] = $id;
        }

        $nome = $this->getModel()->getNome();
        if ($nome) {
            $conditions[] = "nome LIKE ?";
            $params[] = "%$nome%";
        }

        $documento = $this->getModel()->getDocumento();
        if ($documento) {
            $conditions[] = "documento = ?";
            $params[] = $documento;
        }

        $telefone = $this->getModel()->getTelefone();
        if ($telefone) {
            $conditions[] = "telefone = ?";
            $params[] = $telefone;
        }

        return [$conditions, $params];
    }
}
