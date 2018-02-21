<?php

namespace App\Repositories;

use DB;

class Repository implements IRepository
{
    public static function getAll($entity)
    {
        $result = [];
        foreach(DB::table($entity->getTable())->get()->toArray() as $row)
        {
            $result[] = get_object_vars($row);
        }
        return $result;
    }
}