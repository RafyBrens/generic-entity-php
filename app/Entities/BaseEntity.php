<?php
namespace App\Entities;
use App\Repositories\Repository;

/**
 * 
 */
trait BaseEntity
{
    public $id;
    public $rowId;
    public $created_at;
    public $created_by;
    public $updated_at;
    public $deleted_at;

    public function __get($name)
    {
        $this->ifIssetFields();
        if (array_key_exists($name, $this->_fields)) {
            return $this->_fields[$name];
        }
        return null;
    }

    public function __set($name, $value)
    {
        $this->ifIssetFields();
        if (in_array($name, $this->_fields, 1)) {
            $this->{$name} = $value;
        }
    }

    protected function setAttributes($data = [])
    {
        if (!empty($data)) {
            foreach ($data as $k => $v) {
                $this->{$k} = $v;
            }
        }
    }

    public function __toArray()
    {
        return get_object_vars($this);
    }

    /**
     *
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     *
     * @param array $data
     * @return Entity object
     */
    public static function prepareEntity($data, $removeFields = false)
    {
        $obj = null;
        if ($data && !empty($data)) {
            $obj = new static();
            $obj->setAttributes($data);
            if ($removeFields) {
                unset($obj->_fields);
                unset($obj->table);
                unset($obj->hidden);
                unset($obj->fillable);
            }
        }
        return $obj;
    }

    /**
     *
     * @param array $data
     * @return array
     */
    public static function toArray($data)
    {
        $array = [];

        foreach ($data as $value) {
            $array[$value->id] = $value->name;
        }
        return $array;
    }

    /**
     *
     * @throws \Exception
     */
    private function ifIssetFields()
    {
        if (!(property_exists($this, '_fields'))) {
            throw new \Exception('No data set for fields');
        }
    }

    public function printDD($ms)
    {
        dump($ms, $this);
    }

    public function getAll()
    {
        Repository::getAll($this->table);
    }
}