<?php

namespace App\Database;

use Exception;

class Database
{
    private $mysqli;

    public function __construct($host, $db, $user, $pass)
    {
        $this->mysqli = new \mysqli($host, $user, $pass, $db);

        if ($this->mysqli->connect_errno) {
            throw new \RuntimeException('Database connection error: ' . $this->mysqli->connect_error);
        }

        $this->mysqli->set_charset('utf8');
    }

    private function stmt($sql, $params = [])
    {
        $stmt = $this->mysqli->prepare($sql);
        if ($stmt === false) {
            throw new \RuntimeException('Prepare failed: ' . $this->mysqli->error);
        }

        // Determine the types of the parameters
        $types = '';
        foreach ($params as $param) {
            $types .= is_int($param) ? 'i' : (is_double($param) ? 'd' : 's');
        }
        $stmt->bind_param($types, ...$params);

        // Execute the statement
        $stmt->execute();
        if ($stmt->error) {
            throw new \RuntimeException('Execute failed: ' . $stmt->error);
        }

        return $stmt;
    }

    public function query($sql, $params = [])
    {
        // If no parameters, perform a simple query
        if (empty($params)) {
            $result = $this->mysqli->query($sql);
            if ($this->mysqli->error) {
                throw new \RuntimeException('Query failed: ' . $this->mysqli->error);
            }
            return $result;
        }

        // Prepare the statement for parameterized query        
        $stmt = $this->stmt($sql, $params);

        // Determine the type of SQL query and return appropriate result
        $result = preg_match('/^(SELECT|SHOW|DESCRIBE|EXPLAIN)/i', $sql) ?
            $stmt->get_result() : $result = $stmt->affected_rows;

        // Close the statement
        $stmt->close();

        return $result;
    }

    public function fetchAll($sql, $params = [])
    {
        $result = $this->query($sql, $params);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function fetch($sql, $params = [])
    {
        $result = $this->query($sql, $params);
        return $result->fetch_assoc();
    }

    public function insert($sql, $params = [])
    {
        // Prepare the statement for the INSERT query
        $stmt = $this->stmt($sql, $params);

        // Get the last inserted ID
        $lastId = $this->mysqli->insert_id;
        $stmt->close();

        return $lastId;  // Return the last inserted ID
    }

    public function delete($sql, $params = [])
    {
        // Prepare the statement for the DELETE query
        $stmt = $this->stmt($sql, $params);

        // Check the number of affected rows
        $affectedRows = $stmt->affected_rows;
        $stmt->close();

        return $affectedRows;  // Return the number of affected rows
    }

    public function close()
    {
        $this->mysqli->close();
    }
}
