<?php

/**
 * Description of DataAccess
 * Design pattern: Creational -> Singleton
 * @author enxil
 */

class DataAccess
{
    private static $instance;
    private PDO $_conn;
    private $_configuration;

    private function __construct()
    {
        $this->LoadConfiguration();
        $this->OpenConnection();
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function LoadConfiguration()
    {
        $configJSON = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Configuration.json");
        $this->_configuration = json_decode($configJSON);
    }

    private function OpenConnection()
    {
        $dsn = "mysql:host={$this->_configuration->Database->ServerName};dbname={$this->_configuration->Database->DatabaseName}";
        try {
            $this->_conn = new PDO(
                $dsn,
                $this->_configuration->Database->Username,
                $this->_configuration->Database->Password
            );
            $this->_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new Exception("Connection failed");
        }
    }

    // todo: solve cnt close conn
    private function CloseConnection()
    {
        // $this->_conn = null;
    }

    private function BeginTransaction()
    {
        $this->_conn->beginTransaction();
    }

    private function CommitTransaction()
    {
        $this->_conn->commit();
    }

    private function RollbackTransaction()
    {
        $this->_conn->rollback();
    }

    public function BeginDatabase(callable $process)
    {
        try {
            $this->BeginTransaction();
            $output = $process($this);
            $this->CommitTransaction();
            return $output;
        } catch (Throwable $ex) {
            $this->RollbackTransaction();
            throw $ex;
        } finally {
            $this->CloseConnection();
        }
    }

    //$exceptionHandler optional
    public function Reader(string $sql, callable $bindParameter, callable $domainMapping, callable $exceptionHandler = null) : array
    {
        $output = [];
        $stmt = $this->_conn->prepare($sql);
        try {
            $bindParameter($stmt);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $row) {
                $data = $domainMapping($row);
                array_push($output, $data);
            }
            return $output;
        } catch (Throwable $e) {
            if ($exceptionHandler) {
                $exceptionHandler($e);
            }
            throw ($e);
        } finally {
            $stmt->closeCursor();
        }
    }

    public function Scalar(string $sql, callable $bindParameter, callable $exceptionHandler = null)
    {
        $stmt = $this->_conn->prepare($sql);
        try {
            $bindParameter($stmt);
            $stmt->execute();
            // if nothing, return null
            return $stmt->fetchColumn() ?? null;
        } catch (Throwable $e) {
            if ($exceptionHandler) {
                $exceptionHandler($e);
            }
            throw ($e);
        } finally {
            $stmt->closeCursor();
        }
    }

    public function NonQuery(string $sql, callable $bindParameter, callable $exceptionHandler = null) : int
    {
        $stmt = $this->_conn->prepare($sql);
        try {
            $bindParameter($stmt);
            $stmt->execute();
            $result = $this->_conn->lastInsertId();
            return $result;
        } catch (Throwable $e) {
            if ($exceptionHandler) {
                $exceptionHandler($e);
            }
            throw ($e);
        } finally {
            $stmt->closeCursor();
        }
    }
}
