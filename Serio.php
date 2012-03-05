<?php

class Serio
{

    private $link;
    private $result;


    public function __construct()
    {
        $this->_connectDB();

    }

    private function _connectDB()
    {
        include_once 'SerioConf.php';

        $this->link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        if (mysqli_connect_errno()) {
            printf("Serio says: Connect failed - %s\n", mysqli_connect_error());
        }
    }


    private function _cloneDbMemory($table){

        $query = "CREATE TABLE t_copy LIKE $table;
        ALTER TABLE t_copy engine=mefasdfasdm;
        INSERT INTO t_copy SELECT * FROM $table;";

         mysqli_query($this->link, $query);

    }



    public function WriteRow($table, $data)
    {
        $data = serialize($data);
        $query = "INSERT INTO `$table` VALUES (UUID(), '$data')";
        var_dump($query);
        $this->result = mysqli_query($this->link, $query);

    }

    public function SearchRows($table, $data)
    {
        //$this->_cloneDbMemory($table);

        $query = "SELECT SQL_NO_CACHE * FROM `$table` WHERE data_pack LIKE '%$data%' ";
        //$query = "SELECT * FROM `$table` WHERE data_pack LIKE '%$data%' ";

        if ($this->result = mysqli_query($this->link, $query)) {
            /* fetch object array */
            while ($row = $this->result->fetch_row()) {
                printf("%s (%s)\n", $row[0], $row[1]);
            }
        }

    }

    public function __destruct()
    {
        if (!$this->result) {
            printf("Serio says: %s\n", mysqli_error($this->link));
        }

        if ($this->link) {
            mysqli_free_result($this->result);
        }

        mysqli_close($this->link);
    }

}
