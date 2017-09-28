<?php
namespace DIP\tools;

use RedBeanPHP\R;

abstract class dao
{
    protected $class;
    protected static $_instances = array();

    abstract public static function getInstances();

    /** Send a request to the API to return all of the recording of one table
     * @return array
     */
    public function findAll(){
        $result = R::find($this->class);
        return $result;
    }
}
?>
