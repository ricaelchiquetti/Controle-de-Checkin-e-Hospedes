<?php

$migrations = [
    include 'migrations/202312012359_create_table_checkins.php',
    include 'migrations/202312022359_create_table_hospedes.php',
];

// Executa as migrações
foreach ($migrations as $migration) {
    $migration->up();
}

// Se precisar reverter as migrações
// foreach (array_reverse($migrations) as $migration) {
//     $migration->down();
// }