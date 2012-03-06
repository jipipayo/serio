<?php
/*
 * ----------------------------------------------------------------------------
 * "THE BEER-WARE LICENSE":
 * <daniel.remeseiro@gmail.com> wrote this file. As long as you retain this notice you
 * can do whatever you want with this stuff. If we meet some day, and you think
 * this stuff is worth it, you can buy me a beer in return.
 * ----------------------------------------------------------------------------
 */


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


    public function writeRow($table, $data)
    {
        $data = serialize($data);
        $query = "INSERT INTO `$table` VALUES (UUID(), '$data')";
        var_dump($query);
        $this->result = mysqli_query($this->link, $query);

    }


    public function searchRows($table, $data)
    {
        $result = null;

        $query = "SELECT SQL_NO_CACHE * FROM `$table` WHERE
         MATCH data_pack AGAINST ('" . mysql_real_escape_string($data) . "' IN BOOLEAN MODE)";

        if ($this->result = mysqli_query($this->link, $query)) {
            $i = 0;
            while ($row = $this->result->fetch_row()) {
                $row[1] = unserialize($row[1]);
                $rows[$i][0] = $row[0];
                $rows[$i][1] = $row[1];
                $i++;
            }
            $result = $rows;
        }

        //var_dump($result);
        return $result;
    }


    public function __destruct()
    {
        if (!$this->result) {
            printf("Serio says: %s\n", mysqli_error($this->link));
        }

        if ($this->link) {
            mysqli_close($this->link);
        }

        if ($this->result) {
            mysqli_free_result($this->result);
        }


    }

}
