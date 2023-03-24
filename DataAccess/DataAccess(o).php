<?php

#  Author: Lim En Xi
// database transaction

class DataAccess
{
    private mysqli $_conn; 
    private $_configuration;

    public function __construct()
    {
        //refer to the method within the same class
        $this->LoadConfiguration();
        $this->OpenConnection();
    }

    private function LoadConfiguration()
    {//store json of  into a varibale configJson
    //what configJSON store now is a string, it's like a full content in text file
        $configJSON = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Configuration.json");
        $this->_configuration = json_decode($configJSON);

    //decode configJSON into php object and store into variable _configuration
    //after decode the configJSON is now become json struct and can be accessed through ->
    //we can use -> to a string that's why decode is needed
}

    private function OpenConnection()
    {
        $this->_conn = new mysqli(
            $this->_configuration->Database->ServerName,
            $this->_configuration->Database->Username,
            $this->_configuration->Database->Password,
            $this->_configuration->Database->DatabaseName
        );
        // Check connection
        if ($this->_conn->connect_error) {
            die("Connection failed: " . $this->_conn->connect_error);
            print_r($this->_conn->connect_error);
        }
    }

    private function CloseConnection()
    {
        $this->_conn->close();
    }

    private function BeginTransaction()
    {
        $this->_conn->autocommit(false);
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
        $this->OpenConnection();
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

    public function Reader(string $sql, callable $bindParameter): array
    {
        $output = array();
        $stmt = $this->_conn->prepare($sql);
        try {
            $bindParameter($stmt);
            if(!$stmt->execute()){
                throw new Exception($stmt->error);
            }
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    array_push($output, (json_decode(json_encode($row))));
                }
            }
            return $output; 
        } finally {
            $stmt->close();
        }
    }

    public function Scalar(string $sql, callable $bindParameter)
    {

        $stmt = $this->_conn->prepare($sql);
        try {
            $bindParameter($stmt);
            if(!$stmt->execute()){
                throw new Exception($stmt->error);
            }
            $result = $stmt->get_result();
            // if nothing, return null
            return $result->fetch_row()[0] ?? null;
        } finally {
            $stmt->close();
        }
    }

    public function NonQuery(string $sql, callable $bindParameter): int
    {
        $stmt = $this->_conn->prepare($sql);
        try {
            $bindParameter($stmt);
            if(!$stmt->execute()){
                throw new Exception($stmt->error);
            }
            $result = $stmt->insert_id;
            return $result;
        } finally {
            $stmt->close();
        }
    }

}
