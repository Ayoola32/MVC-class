<?php

Trait Model{
    use Database;
    protected $limit = 10;
    protected $offset = 0;
	protected $order_column = "id";
	public $errors 		= [];


    public function test(){
        $sql = "SELECT * FROM $this->table";
        $result = $this->query($sql);
        show($result);
    }

    public function findAll(){
		$query = "SELECT * FROM $this->table ORDER BY $this->order_column DESC LIMIT $this->limit OFFSET $this->offset";
		return $this->query($query);
	}


    public function where($data, $data_not = []){
        $keys = array_keys($data);
        $keys_not = array_keys($data_not);
        $query = "SELECT * FROM $this->table WHERE ";

        foreach ($keys as $key) {
            $query .= $key . " = :" .$key . " && ";
        }

        foreach ($keys_not as $key) {
            $query .= $key . " != :" .$key . " && ";
        }

        $query = trim($query, " && ");
        $query .= " ORDER BY $this->oder_column DESC LIMIT $this->limit OFFSET $this->offset";
        $data = array_merge($data, $data_not);
        $result = $this->query($query, $data);
        return $result;
    }


    public function first($data){
        $keys = array_keys($data);
        $keys_not = array_keys($data_not);
        $query = "SELECT * FROM $this->table WHERE ";

        foreach ($keys as $key) {
            $query .= $key . " = :" .$key . " && ";
        }

        foreach ($keys_not as $key) {
            $query .= $key . " != :" .$key . " && ";
        }

        $query = trim($query, " && ");
        $query .= " LIMIT $this->limit OFFSET $this->offset";
        $data = array_merge($data, $data_not);
        $result = $this->query($query, $data);
        return $result ? $result[0] :  false;
        
    }

    
    public function create($data){
        if(!empty($this->allowedColumns)){
            foreach ($data as $key => $value) {
                
                if(!in_array($key, $this->allowedColumns)){
                    unset($data[$key]);
				}
			}
		}
        
		$keys = array_keys($data);
        
        $query = "INSERT INTO $this->table (". implode(", ", $keys) .") VALUES (:" . implode(", :", $keys) . ")";
		$this->query($query, $data);

		return false;

    }

    
    public function update($id, $data, $id_column = 'id'){
        if(!empty($this->allowedColumns))
		{
            foreach ($data as $key => $value) {
                if(!in_array($key, $this->allowedColumns)){
                    unset($data[$key]);
				}
			}
		}
        
		$keys = array_keys($data);
        $query = "UPDATE $this->table SET ";

		foreach ($keys as $key) {
			$query .= $key . " = :". $key . ", ";
		}

		$query = trim($query,", ");

		$query .= " where $id_column = :$id_column ";

		$data[$id_column] = $id;

		$this->query($query, $data);
		return false;
    }

    
    public function delete($id, $id_column = 'id') {
        $data = [];
        $data[$id_column] = $id;
        $query = "DELETE FROM $this->table WHERE $id_column = :$id_column";
    
        $this->query($query, $data);
    }
    
    
}
