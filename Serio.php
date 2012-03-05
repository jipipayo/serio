<?php

class Serio
{

    private $link;
    private $result;


    public function __construct(){
        $this->_connectDB();
    }

    private  function _connectDB()
    {
        include_once 'SerioConf.php';

        $this->link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        if (mysqli_connect_errno()) {
            printf("Serio says: Connect failed - %s\n", mysqli_connect_error());
        }
    }


    public function WriteRow($table, $data)
    {
        $data = serialize($data);
        $query = "INSERT INTO `$table`  VALUES ( UUID(), '$data')";
        var_dump($query);
        $this->result = mysqli_query($this->link, $query);

    }


    public function __destruct()
    {
        if (!$this->result) {
            printf("Serio says: %s\n", mysqli_error($this->link));
        }

        if ($this->link) {
            mysqli_close($this->link);
            exit();
        }
    }

}
