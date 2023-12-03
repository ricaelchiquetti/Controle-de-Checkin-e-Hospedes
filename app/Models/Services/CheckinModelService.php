<?php

namespace App\Models\Services;

use App\Models\Checkin;

/**
 * Serviço de manipulação de dados relacionados aos Checkins.
 * @package App\Models\Services
 * @author Ricael V. Chiquetti <ricaelchiquetti28@gmail.com>
 * 
 * @method Checkin getModel()
 */
class CheckinModelService extends ModelDataService {

    /**
     * {@inheritDoc}
     */
    public function create(): bool {
        $idHospede = $this->getModel()->getHospede()->getId();
        $dataEntrada = $this->getModel()->getDataEntrada();
        $dataSaida = $this->getModel()->getDataSaida();
        $adicionalVeiculo = $this->getModel()->getAdicionalVeiculo();

        $sql = "INSERT INTO hotel_db.checkins (id_hospede, dataEntrada, dataSaida, adicionalVeiculo) VALUES (?, ?, ?, ?)";
        $params = [$idHospede, $dataEntrada, $dataSaida, $adicionalVeiculo];

        return $this->executeQuery($sql, $params);
    }

    /**
     * {@inheritDoc}
     */
    public function update(): bool {
        $id = $this->getModel()->getId();
        $dataEntrada = $this->getModel()->getDataEntrada();
        $dataSaida = $this->getModel()->getDataSaida();
        $adicionalVeiculo = $this->getModel()->getAdicionalVeiculo();

        $sql = "UPDATE hotel_db.checkins 
                   SET dataEntrada = ?, dataSaida = ?, adicionalVeiculo = ? 
                 WHERE id = ?";
        $params = [$dataEntrada, $dataSaida, $adicionalVeiculo, $id];

        return $this->executeQuery($sql, $params);
    }

    /**
     * {@inheritDoc}
     */
    public function delete(): bool {
        $id = $this->getModel()->getId();

        $sql = "DELETE FROM hotel_db.checkins WHERE id = ?";
        $params = [$id];

        return $this->executeQuery($sql, $params);
    }

    /**
     * {@inheritDoc}
     */
    protected function getSelectQuery(array $conditions = []): string {
        $sql = "SELECT * FROM hotel_db.checkins";

        if (!empty($conditions)) {
            $condition = implode(" AND ", $conditions);
            $sql .= " WHERE $condition ";
        }

        return $sql;
    }

    /**
     * {@inheritDoc}
     */
    protected function getConditionSql(): array {
        $conditions = [];
        $params = [];

        $idHospede = $this->getModel()->getHospede()->getId();
        if ($idHospede) {
            $conditions[] = "id_hospede = ?";
            $params[] = $idHospede;
        }

        $dataEntrada = $this->getModel()->getDataEntrada();
        if ($dataEntrada) {
            $conditions[] = "dataEntrada = ?";
            $params[] = $dataEntrada;
        }

        $dataSaida = $this->getModel()->getDataSaida();
        if ($dataSaida) {
            $conditions[] = "dataSaida = ?";
            $params[] = $dataSaida;
        }

        $adicionalVeiculo = $this->getModel()->getAdicionalVeiculo();
        if ($adicionalVeiculo) {
            $conditions[] = "adicionalVeiculo = ?";
            $params[] = $adicionalVeiculo;
        }

        return [$conditions, $params];
    }
}
