<?php
namespace core;
class connectPDO {
    protected $db;
    private $settings = "mysql:host=localhost;dbname=sitenews";
    //private $settings = "mysql:host=mysql.hostinger.com.ua;dbname=u296156972_news";

    function __construct() {
        try {
            $this->db = new \PDO($this->settings, "root", "");
            //$this->db = new \PDO($this->settings, "vtshark", "");
        }
        catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}
class IDB extends connectPDO  {
    private $arrBind = [];

    private function getField($field) {
        return "`".str_replace("`","``",$field)."`";
    }

    private function whatFun($what,$mode) {
        //$str_what = ($what) ? implode(',', $what) : "*";
        $str_what = "";
        switch ($mode) {
            case "select":
                if ($what) {
                    $buf = "";
                    foreach ($what as $v) {
                        $str_what .= $buf . $this->getField($v);
                        $buf = " ,";
                    }
                } else {
                    $str_what = "*";
                }
                break;

            case "insert":
                if ($what) {
                    $buf = "";
                    foreach ($what as $k => $v) {
                        $str_what .= $buf . $this->getField($k) . " = ?";
                        $this->arrBind[] = $v;
                        $buf = " ,";
                    }
                }

                break;
        }
        return $str_what;
    }

    private function whereFun($where) {
        $str_where = "";
        if ($where) {
            $str_where = " WHERE";
            $and = "";
            foreach ($where as $k=>$v) {
                $str_where .= "$and `$k` = ? ";
                $and = " AND ";
                $this->arrBind[] = $v;
            }
        }
        return $str_where;
    }

    private function orderFun($orderColumn,$desc) {
        $str_ordCol = "";
        if ($orderColumn) {
            //$field = "`".str_replace("`","``",$orderColumn)."`";
            //$str_ordCol = " ORDER BY $field";
            $str_ordCol = " ORDER BY ".$this->getField($orderColumn);
            $str_desc = " ASC";
            if ($desc) {
                $dirs = array("ASC", "DESC");
                $key = array_search($desc, $dirs);
                $dir = $dirs[$key];
                $str_desc = " $dir";
            }
            $str_ordCol .= $str_desc;
        }
        return $str_ordCol;
    }

    private function limitFun($limit) {
        //$str_limit = ($limit) ? " LIMIT ".implode($limit, ", ") : " LIMIT 0,30";
        if ($limit) {
            $str_limit = " LIMIT ";
            $buf = "";
            foreach ($limit as $v) {
                $str_limit .= $buf."?";
                $buf = ", ";
                $this->arrBind[] = $v;
            }
        } else {
            $str_limit = " LIMIT 0,30";
        }
        return $str_limit;
    }

    /**
     * @param $table - Назва таблиці
     * @param $what - масив колонок, які потрібно повернути (якщо false - тоді всі колонки)
     * @param $where - асоціативний масив колонка - значення
     * @param $orderColumn - колонка по якій сортувати
     * @param $desc - напрям сортування
     * @param $limit - масив ліміту ([0-30]) за умовчуванням 0-30
     * @return mixed - результативний масив
     */
    function select($table, $what, $where, $orderColumn, $desc, $limit)
    {
        $str_what = $this->whatFun($what,"select");
        $str_where = $this->whereFun($where);
        $str_ordCol = $this->orderFun($orderColumn,$desc);
        $str_limit = $this->limitFun($limit);

        $sql = "SELECT $str_what FROM `$table`" . $str_where . $str_ordCol . $str_limit;
        $query = $this->db->prepare($sql);

        //bind sqlstr
        $kolLim = count($limit);
        $kolArr = count($this->arrBind) - $kolLim;
        for ($i = 0; $i < $kolArr; $i++ ) {
            $query->bindParam($i+1,$this->arrBind[$i],\PDO::PARAM_STR);
        }
        //bind Limit
        for (;$i < $kolArr + $kolLim; $i++ ) {
            $query->bindValue($i+1,$this->arrBind[$i],\PDO::PARAM_INT);
        }
        $query->execute();
        $array = $query->fetchAll(\PDO::FETCH_ASSOC);
        $this->arrBind = [];
        return $array;
    }
    function countAllrec($table,$where) {
        $str_where = $this->whereFun($where);
        $sql = "SELECT count(*) as `kol` FROM `$table`".$str_where;
        $query = $this->db->prepare($sql);

        $kolArr = count($this->arrBind);
        for ($i = 0; $i < $kolArr; $i++ ) {
            $query->bindParam($i+1,$this->arrBind[$i],\PDO::PARAM_STR);
        }

        $query->execute();
        $array = $query->fetchAll(\PDO::FETCH_ASSOC);
        $this->arrBind = [];
        return (int)$array[0]['kol'];
    }

    /**
     * @param $table - Назва таблиці
     * @param $what - масив колонок, які потрібно повернути (якщо false - тоді всі колонки)
     * @return mixed - ід елементу
     */
    function insert($table, $what)
    {
        $str_what = $this->whatFun($what,"insert");
        $sql = "INSERT INTO {$this->getField($table)} SET $str_what";
        $query = $this->db->prepare($sql);
        $query->execute($this->arrBind);
        $insertId = $this->db->lastInsertId();
        $this->arrBind = [];
        return $insertId;
    }

    /**
     * @param $table - Назва таблиці
     * @param $what - масив колонок, які потрібно повернути (якщо false - тоді всі колонки)
     * @param $where - асоціативний масив колонка - значення
     * @return mixed
     */
    function update($table, $what, $where)
    {
        $str_what = $this->whatFun($what,"insert");
        $str_where = $this->whereFun($where);
        $sql = "UPDATE {$this->getField($table)}  SET $str_what $str_where";
        $query = $this->db->prepare($sql);
        $query->execute($this->arrBind);
        $this->arrBind = [];
    }

    /**
     * @param $table - Назва таблиці
     * @param $what - масив колонок, які потрібно повернути (якщо false - тоді всі колонки)
     * @return mixed
     */
    function delete($table, $where)
    {
        if ($where) {
            $str_where = $this->whereFun($where);
            $sql = "DELETE FROM {$this->getField($table)} $str_where";
            $query = $this->db->prepare($sql);
            $query->execute($this->arrBind);
            $this->arrBind = [];
        }
    }
    function sendQuery($sql) {
        //var_dump($sql);
        $query = $this->db->prepare($sql);
        $query->execute();
        $array = $query->fetchAll(\PDO::FETCH_ASSOC);
        return $array;
    }
}