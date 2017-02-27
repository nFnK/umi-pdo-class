<?php

class Database
{
      private static $dbName = '_pdo';
      private static $dbHost = 'localhost';
      private static $dbUsername = 'root';
      private static $dbUserPassword = 'root';
      private static $dbset = 'utf8';

      private static $cont = null;

      public function __construct()
      {
            die('Init function is not allowed');
      }

      public static function connect()
      {
            // One connection through whole application
            if(null == self::$cont)
            {
                  try
                  {
                        self::$cont = new PDO("mysql:host=" . self::$dbHost . ";" . "dbname=" . self::$dbName, self::$dbUsername, self::$dbUserPassword);
                        self::$cont->exec("SET NAMES " . self::$dbset . "");
                  }
                  catch (PDOException $e)
                  {
                        die("Error: it cannot display  " /*.$e->getMessage()*/ );
                  }
            }
            return self::$cont;
      }

      public static function disconnect()
      {
            self::$cont = null;
      }
}


class CRUD extends Database
{

      protected $db;

      function __construct()
      {
            $this->db = parent::connect();
      }

      function __destruct()
      {
            $this->db = parent::disconnect();
      }


      public function insert($table, $params = array())
      {
            $query = $this->db->prepare('INSERT INTO `' . $table . '` (' . implode(',', array_keys($params)) . ') VALUES (:' . implode(',:',array_keys($params)) . ')');
            $query->execute($params);
            return $this->db->lastInsertId();
      }

      public function insertid()
      {
            return $this->db->lastInsertId();
      }

      public function update($table, $id, $params = array())
      {
            $ikey = '';
            foreach ($params as $zzm => $valz)
            {
                  $ikey .= $zzm . " = :" . $zzm . ", ";
            }
            $ikey = rtrim($ikey, ", ");
            $query = $this->db->prepare('UPDATE `' . $table . '` set ' . $ikey . ' where  ' . $id . '');
            $query->execute($params);
            $this->ok = $query->rowCount();
            return $query->rowCount();
      }


      public function select($table, $rows = '*', $join = null, $where = null, $order = null, $limit = null)
      {
            $q = 'SELECT ' . $rows . ' FROM ' . $table;
            if($join != null)
            {
                  $q .= ' JOIN ' . $join;
            }
            if($where != null)
            {
                  $q .= ' WHERE ' . $where;
            }
            if($order != null)
            {
                  $q .= ' ORDER BY ' . $order;
            }
            if($limit != null)
            {
                  $q .= ' LIMIT ' . $limit;
            }
            $query = $this->db->prepare($q);
            $query->execute();
            $data = array();
            while ($row = $query->fetch(PDO::FETCH_ASSOC))
            {
                  $data[] = $row;
            }
            return $data;
      }


      public function details($table, $rows = '*', $where = null, $order = null,  $limit = null)
      {
            $q = 'SELECT ' . $rows . ' FROM ' . $table;
            if($where != null)
            {
                  $q .= ' WHERE ' . $where;
            }
            if($order != null)
            {
                  $q .= ' ORDER BY ' . $order;
            }
            if($limit != null)
            {
                  $q .= ' LIMIT ' . $limit;
            }
            $query = $this->db->prepare($q);
            $query->execute();
            return json_encode($query->fetch(PDO::FETCH_ASSOC));
      }


      public function delete($table, $where = array())
      {
            $ikey = '';
            foreach ($where as $zzm => $valz)
            {
                  $ikey .= $zzm . " = :" . $zzm . " and ";
            }
            $cont = strlen($ikey) - 5;
            $ikey = substr($ikey, 0, $cont);
            $query = $this->db->prepare('DELETE FROM ' . $table . ' where ' . $ikey . '');
            $query->execute($where);
            $this->ok = $query->rowCount();
            return $query->rowCount();
      }


}

?>