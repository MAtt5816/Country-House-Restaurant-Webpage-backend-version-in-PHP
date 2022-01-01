<?php
  class Database
  {
    private $mysqli;

    function __construct($server, $user, $passwd, $base)
    {
      $this->mysqli = new mysqli($server, $user, $passwd, $base);
      if ($this->mysqli->connect_errno) {
        printf("Nie udało sie połączenie z serwerem: %s\n",
          $mysqli->connect_error);
        exit();
      }
      if (!($this->mysqli->set_charset("utf8"))) {
        printf("Nie udało się zmienić kodowania na UTF-8. %s\n");
      }
    }

    function __destruct(){
      $this->mysqli->close();
    }

    public function last_id(){
      return $this->mysqli->insert_id;
    }

    public function transaction(){
      return $this->mysqli->begin_transaction();
    }

    public function rollback(){
      return $this->mysqli->rollback();
    }

    public function commit(){
      return $this->mysqli->commit();
    }

    public function select($sql, $fields) {
        // $sql arg – SELECT query
        // $fields arg - array with fields names in DB
        //result – association array with ressult from DB
        $content = array();
        if ($result = $this->mysqli->query($sql)) {
            $count_fields = count($fields); //how many fileds
            $count_rows = $result->num_rows; //how many rows
            $j = 0;
            while ($row = $result->fetch_object()) {
                for ($i = 0; $i < $count_fields; $i++) {
                    $p = $fields[$i];
                    $content[$j][$p] = $row->$p;
                }
                $j++;
            }
            $result->close();
        }
        return $content;
    }

    public function delete($sql) {
        // TODO
    }

    public function insert($sql) {
        if( $this->mysqli->query($sql)) return true; else return false;
    }

    public function getMysqli() {
        return $this->mysqli;
    }
  }
?>
