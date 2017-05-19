<?php namespace model;

use ConfigRepositorie;

class model {
    private $query_where = '';
    private $realtion_query = '';
    private $select = '*';
    private $data = [];
    private $called_class = '';
    private $instance = '';
    private $orderby = '';
    //db settings
    private $servername = "";
    private $username = "";
    private $password = "";
    private $database = "";

    function __construct($data=array()) {
        $this->setDbSettings();
        $this->setAttributes();
        $this->setData($data);

    }
    // getters
    public function fill($data)
    {
        foreach($data as $key=>$d){
            $this->data[$key] = $d;
        }
        return $this;
    }

    public function get(){
        if(isset($this) && is_object($this)){
            $return = [];
            $result = $this->excecute_query();
            while($row = $result->fetch_assoc()){
                $row = $this->removeProtectedColumn($row);
                $return[] = new $this->called_class($row);
            }
            return $return;
        }
        return self::init()->get();
    }

    public function lists($value,$key = null)
    {
        $return = [];
        foreach($this->get() as $i){
            if($key){
                $return[$i->$key] = $i->$value;
            }
            else{
                $return[] = $i->$value;
            }
        }
        return $return;
    }

    public function find($id)
    {
        if(isset($this) && is_object($this)) {
            $this->where('id', '=', $id);
            return $this->first();
        }
        return self::init()->find($id);
    }

    public function first()
    {
        if(isset($this) && is_object($this)) {
            $return = null;
            $result = $this->excecute_query();
            while ($row = $result->fetch_assoc()) {
                $row = $this->removeProtectedColumn($row);
                foreach ($row as $key => $d) {
                    $this->data[$key] = $d;
                }
                return $this;
            }
            return null;
        }
        return self::init()->first();
    }

    public function update($data)
    {
        if(isset($this) && is_object($this)) {
            foreach ($data as $key => $d) {
                if ($key != 'id') {
                    $this->data[$key] = $d;
                }
            }

            return $this->save();
        }
        return self::init()->update($data);
    }

    public function save()
    {
        if(isset($this) && is_object($this)) {
            if (isset($this->data['id']) && $this->data['id']) {
                $update = '';
                foreach ($this->data as $key => $d) {
                    if ($key != 'id') {
                            if (is_numeric($d)) {
                                $update .= "$key=$d,";

                            } else {
                                $update .= "$key='$d',";

                            }
                    }
                }
                $update = substr_replace($update, "", -1);

                $query = "UPDATE $this->table SET $update WHERE id=$this->id";

                $conn = $this->makeConnection();
                $result = $conn->query($query);
                if (!$result) {
                    die("Error: " . $query . "<br>" . mysqli_error($conn));
                }
            } else {
                $columns = '';
                $inserts = '';
                foreach ($this->data as $key => $d) {
                    if ($key != 'id') {
                        $columns .= $key . ",";
                        if (is_numeric($d)) {
                            $inserts .= $d . ',';

                        } else {
                            $inserts .= "'$d',";

                        }
                    }
                }
                $columns = substr_replace($columns, "", -1);
                $inserts = substr_replace($inserts, "", -1);
                $query = "INSERT INTO $this->table ($columns) VALUES ($inserts)";
                $conn = $this->makeConnection();
                $result = $conn->query($query);

                if (!$result) {
                    die("Error: " . $query . "<br>" . mysqli_error($conn));
                }
                foreach($conn->query("SELECT LAST_INSERT_ID()") as $id){
                    $this->data['id'] = $id['LAST_INSERT_ID()'];
                }
            }


            return $this;
        }
        return self::init()->save();
    }

    public function delete()
    {
        if(isset($this) && is_object($this)) {
            if (isset($this->data['id'])) {
                $id = $this->data['id'];
                $query = "DELETE FROM $this->table WHERE id=$id;";
                $conn = $this->makeConnection();
                $conn->query($query);
            }
            return null;
        }
        return self::init()->delete();
    }
    public function __get($key)
    {
        if(isset($this->data[$key])){
            return $this->data[$key];
        }
    }

    public function __set($key, $value)
    {
        $this->data[$key] = $value;
    }
    //where
    public function where($column,$constructor,$value){
        if(isset($this) && is_object($this)) {
        	if(!strpos($column,'.')){
        		$column = $this->table.'.'.$column;
        	}
            $return = '';
            $return .= $column;
            $return .= " ";
            $return .= $constructor;
            $return .= " ";
            $return .= "'$value'";
            
            if ($this->query_where) {
                $this->query_where .= ' AND ';
            } else {
                $this->query_where .= 'where ';
            }
            $this->query_where .= $return;
            return $this;
        }
        return self::init()->where($column,$constructor,$value);
    }

    public function whereIn($column, $list = array())
    {
        if(isset($this) && is_object($this)) {
        	if(!strpos($column,'.')){
        		$column = $this->table.'.'.$column;
        	}
            if($this->query_where){
                $this->query_where .= ' AND ';
            }
            else{
                $this->query_where .= 'where ';
            }
            $this->query_where .= "$column IN('".implode("','",$list)."')";
            return $this;
        }
        return self::init()->whereIn($column,$list);
    }

    public function orderBy($colum, $order)
    {
        if(isset($this) && is_object($this)) {
            $this->orderby .= "ORDER BY $colum $order";
            return $this;
        }
        return self::init()->orderBy($colum,$order);
    }

    //private functions
    private function makeConnection()
    {
        $conn = new \mysqli($this->servername,$this->username,$this->password,$this->database);
        $conn->set_charset('utf8');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }

    private function removeProtectedColumn($row){
        if(isset($this->protected)) {
            foreach ($this->protected as $key => $r) {
                if(isset($row[$r])) {
                    unset($row[$r]);
                }
            }
        }
        return $row;
    }
    private function setAttributes(){
        $this->called_class = get_called_class();
    }
    private function setData($data){
        if(count($data)) {
            $this->data = $data;
        }
        else{
            $this->set_data_empty();
        }
    }
    public function join($table, $this_foreign, $model_foreign){
        $this->realtion_query = "INNER JOIN $table ON ".$this->table.".".$model_foreign." = ".$table.'.'.$this_foreign;

        return $this;
    }

    private function excecute_query()
    {
        $query = "SELECT $this->select FROM $this->table $this->realtion_query $this->query_where $this->orderby";
        $conn = self::makeConnection();

        $result = $conn->query($query);
        return $result;

    }
    private function set_data_empty(){
        $table = $this->database.'.'.$this->table;
        $query = "SHOW COLUMNS FROM $table";
        $conn = $this->makeConnection();
        $result = $conn->query($query);
        $data=[];
        while($row = $result->fetch_assoc()){
            $data[$row['Field']] = null;
        }
        $this->data = $data;
    }

    private function init($data = array()){
        if(isset($this) && is_object($this)){
            if(!is_null($this->instance)){
                return $this->instance;
            }
            $this->instance = $this;
            return $this->instance;
        }
        $class = get_called_class();

        return new $class($data);
    }
    private function setDbSettings(){
        $config = new ConfigRepositorie();
        $this->servername = $config->get('db_server');
        $this->username = $config->get('db_username');
        $this->password = $config->get('db_password');
        $this->database = $config->get('db_name');
    }

}


?>