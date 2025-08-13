<?php
// app/interfaces/DatabaseInterface.php

interface DatabaseInterface
{
    // Basic CRUD
    public function create(string $table, array $data);
    public function update(string $table, int $id, array $data): bool;
    public function delete(string $table, int $id): bool;
    public function readAll(string $table): array;
    public function getById(string $table, int $id);
    public function getByEmail(string $table, string $email);

    // Query Helpers
    public function query(string $sql);
    public function bind($param, $value, $type = null);
    public function execute();
    public function single();

    // Stored Procedures
    public function callProcedure(string $procedureName, array $params = []): array;

    // Filters
    public function columnFilter(string $table, string $column, $value, ?string $excludeColumn = null, $excludeValue = null);
    public function multiColumnFilter(string $table, array $criteria): ?array;

    // Authentication
    public function loginCheck(string $email, string $password);

    // Access underlying PDO instance if needed
    public function getPdo(): \PDO;
}
