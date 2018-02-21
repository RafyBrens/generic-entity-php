<?php

namespace App\Entities;

class Item implements EntityInterface
{
    use BaseEntity;
    private $price;

    private $_fields = [
        'name',
        'price'
    ];

    private $table = 'items';
}