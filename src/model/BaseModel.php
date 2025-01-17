<?php
namespace App\model;
use App\config\Connexion ;



abstract class BaseModel{

protected $con ;
protected $table_name ;

public function __construct($table_name){
 $this->table_name = $table_name;
 $this->con = Connexion::connection();
}

abstract public function getAll();
abstract public function create($args);
abstract public function edit($args,$id); 
abstract public function delete($id);

}
?>