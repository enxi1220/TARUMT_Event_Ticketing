<?php

/**
 *
 * @author enxil
 */
interface IDataAccess {
    public function BeginDatabase(callable $process);
    public function Reader(string $sql, callable $bindParameter, callable $domainMapping, callable $exceptionHandler);
    public function Scalar(string $sql, callable $bindParameter, callable $exceptionHandler);
    public function NonQuery(string $sql, callable $bindParameter, callable $exceptionHandler);
}
