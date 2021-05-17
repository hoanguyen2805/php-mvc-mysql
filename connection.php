<?php

class Database
{
    private $host = "localhost:3306";
    private $username = "root";
    private $password = "";
    private $database = "phonestore";
    private $sql = "";
    private $connection;

    /**
     *
     * Hoa
     * connect to database
     *
     */
    public function __construct()
    {
        try {
            $this->connection = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->database,
                $this->username, $this->password);
            // để hiển thị tiếng việt
            $this->connection->exec("SET NAMES 'utf8'");
            // ném ra ngoại lệ khi gặp lỗi đồng thời tạo ra PHP Warning
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }


    /**
     *
     * Hoa
     * set sql query
     *
     */
    public function setQuery($sql)
    {
        $this->sql = $sql;
    }

    /**
     *
     * Hoa
     * execute the query
     *
     */
    public function execute($options = array())
    {
        // dùng prepared statement để tránh bị tấn công SQL Injection
        // prepare() tạo ra một Prepared Statement
        $statement = $this->connection->prepare($this->sql);
        // nếu có tham số
        if ($options) {
            for ($i = 0; $i < count($options); $i++) {
                // truyền giá trị cho các tham số trong sql
                $statement->bindParam($i + 1, $options[$i]);
            }
        }
        // thực thi prepared statement
        $statement->execute();
        return $statement;
    }

    /**
     *
     * Hoa
     * Funtion load datas on table
     * return an array, if there is no a record -> array = null or count(array) = 0
     *
     */
    public function loadAllRows($options = array())
    {
        // nếu không có tham số
        if (!$options) {
            // nếu truy vấn lỗi
            $result = $this->execute();
            if (!$result) {
                return false;
            }
        } else {
            // nếu truy vấn lỗi
            $result = $this->execute($options);
            if (!$result) {
                return false;
            }
        }
        // fetchAll la lay nhieu dong du lieu, FETCH_OBJ la tra ve 1 object cua stdClass
        return $result->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     *
     * Hoa
     * Function load a record on the table
     * if not found, return false
     * if found, return a object stdClass
     *
     */
    public function loadRow($option = array())
    {
        if (!$option) {
            $result = $this->execute();
            if (!$result) {
                return false;
            }
        } else {
            $result = $this->execute($option);
            if (!$result) {
                return false;
            }
        }
        return $result->fetch(PDO::FETCH_OBJ);
    }

    /**
     *
     * Hoa
     * Function count the record on the table
     * select count(*) from ... where ...
     *
     */
    public function loadRecord($option = array())
    {
        if (!$option) {
            $result = $this->execute();
            if (!$result) {
                return false;
            }
        } else {
            $result = $this->execute($option);
            if (!$result) {
                return false;
            }
        }
        return $result->fetch(PDO::FETCH_COLUMN);
    }

    /**
     *
     * get last id of table
     *
     */
    public function getLastId()
    {
        return $this->connection->lastInsertId();
    }

    public function disconnect()
    {
        $this->connection = null;
    }
}

?>