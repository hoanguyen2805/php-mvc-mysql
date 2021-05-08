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
     * Create at
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


    public function setQuery($sql)
    {
        $this->sql = $sql;
    }

    //Function execute the query
    public function execute($options = array())
    {
        // dùng prepared statement để tránh bị tấn công SQL Injection
        // prepare() tạo ra một Prepared Statement
        $statement = $this->connection->prepare($this->sql);
        //neu co tham so
        if ($options) {  //If have $options then system will be tranmission parameters
            for ($i = 0; $i < count($options); $i++) {
                // truyền giá trị cho các tham số trong sql
                $statement->bindParam($i + 1, $options[$i]);
            }
        }
        // thực thi prepared statement
        $statement->execute();
        return $statement;
    }

    //Funtion load datas on table
    public function loadAllRows($options = array())
    {
        // nếu không có tham số
        if (!$options) {
            // nếu truy vấn lỗi
            if (!$result = $this->execute()) {
                return false;
            }
        } // nếu có tham số
        else {
            // nếu truy vấn lỗi
            if (!$result = $this->execute($options)) {
                return false;
            }
        }
        // fetchAll la lay nhieu dong du lieu, FETCH_OBJ la tra ve 1 object cua stdClass
        return $result->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     *
     * Funtion load 1 data on the table
     * không tìm thấy trả về false
     * tìm thấy trả về 1 object của stdClass
     *
     */
    public function loadRow($option = array())
    {
        if (!$option) {
            if (!$result = $this->execute()) {
                return false;
            }
        } else {
            if (!$result = $this->execute($option)) {
                return false;
            }
        }
        return $result->fetch(PDO::FETCH_OBJ);
    }

    /**
     *
     * Function count the record on the table
     * trả về số bản ghi: select count(*) from ...
     */
    public function loadRecord($option = array())
    {
        if (!$option) {
            if (!$result = $this->execute()) {
                return false;
            }
        } else {
            if (!$result = $this->execute($option)) {
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