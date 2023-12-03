<?php

namespace App\Models\Services;

use App\Database;
use App\Models\ModelBase;

/**
 * Serviço para manipulação de dados relacionados ao modelo
 * @package App\Service
 * @author Ricael V. Chiquetti <ricaelchiquetti28@gmail.com>
 */
abstract class ModelDataService implements ModelDataServiceInterface {

    /** @var ModelBase */
    protected $model;

    /**
     * Contruict do Model
     * @param ModelBase $model
     */
    public function __construct(ModelBase $model) {
        $this->model = $model;
    }

    /**
     * Retorna uma instancia do Model
     * @return ModelBase
     */
    public function getModel(): ModelBase {
        return $this->model;
    }

    /**
     * Define uma instancia do Model
     * @param ModelBase $model
     * @return ModelDataService
     */
    public function setModel(ModelBase $model): ModelDataService {
        $this->model = $model;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function find(): array {
        list($conditions, $params) = $this->getConditionSql();
        $sql = $this->getSelectQuery($conditions);
        return $this->executeQuery($sql, $params);
    }

    /**
     * Retorna a Query do Select
     * @param array $conditions
     * @return string
     */
    abstract protected function getSelectQuery(array $conditions = []): string;

    /**
     * Retorna as Condições e os parametros do SQL
     * @return array
     */
    abstract protected function getConditionSql(): array;

    /**
     * Executa um SQL de consulta no BD
     * @param string $sql
     * @param array $params
     * @return array|bool
     */
    protected function executeQuery(string $sql, array $params = []): array|bool {
        $conn = Database::getConnection();

        $stmt = $conn->prepare($sql);
        if ($stmt) {
            if (!empty($params)) {
                $types = str_repeat('s', count($params));
                $stmt->bind_param($types, ...$params);
            }

            $executed = $stmt->execute();

            if (stripos($sql, 'SELECT') === 0) {
                if ($executed) {
                    $result = $stmt->get_result();
                    $rows = $result->fetch_all(MYSQLI_ASSOC);
                    $stmt->close();
                    $conn->close();
                    return $rows;
                } else {
                    return [];
                }
            } else {
                $stmt->close();
                $conn->close();
                return $executed;
            }
        }
        return false;
    }

    public function startTransaction(): void {
        Database::getConnection()->begin_transaction();
    }

    public function rollbackTransaction(): void {
        Database::getConnection()->rollBack();
    }

    public function commitTransaction(): void {
        Database::getConnection()->commit();
    }
}
