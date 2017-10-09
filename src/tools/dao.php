<?php
namespace DIP\tools;

use RedBeanPHP\R;

abstract class dao
{
    protected $class;
    protected static $_instances = array();

    abstract public static function getInstances();

    /** return all of the recording of one table
     * @return array
     */
    public function findAll(){
        $result = R::find($this->class);
        return $result;
    }

    /*
     * Return the recording which correspond to id of one table
     */
    public function findOneById($id)
    {
        $result = R::findOne($this->class, 'id = ?', [$id]);
        return $result;
    }
}
