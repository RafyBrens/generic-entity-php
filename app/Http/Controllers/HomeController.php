<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Entities\EntityInterface;
use App\Entities\User;
use App\Entities\Item;

class HomeController extends Controller
{
    public function index()
    {
        $item = new Item();
        $user = new User();
        $this->getAll($user);
        $item->prepareEntity(['price' => 9]);
        $this->printDD('item', $item);
        $this->printDD('user', $user);
    }

    public function getAll($user)
    {
        $data = User::entityToArray(User::getAll($user));
        dd($data);
    }

    public function printDD(string $ms, EntityInterface $entity)
    {
        $entity->printDD($ms, $entity);        
    }
}
