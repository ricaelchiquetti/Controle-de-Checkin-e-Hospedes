<?php

class CreateTableHospedes {

    public function up($pdo) {
        $sql = "
    CREATE TABLE Checkins (
        id INT AUTO_INCREMENT PRIMARY KEY COMMENT 'ID',
        id_hospede INT NOT NULL COMMENT 'ID do hóspede',
        FOREIGN KEY (id_hospede) REFERENCES Hospedes(id),
        dataEntrada DATETIME NOT NULL COMMENT 'Data de entrada',
        dataSaida DATETIME NOT NULL COMMENT 'Data de saída',
        adicionalVeiculo BOOLEAN NOT NULL COMMENT 'Adicional de veículo',
        dataAtualizacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Data da última atualização',
        FOREIGN KEY (id_hospede) REFERENCES Hospedes(id)
    ) COMMENT = 'Informações dos check-ins';
    ";

        $pdo->exec($sql);
    }

    public function down($pdo) {
        $sql = "DROP TABLE IF EXISTS Checkins;";
        $pdo->exec($sql);
    }
}

return new CreateTableHospedes();
