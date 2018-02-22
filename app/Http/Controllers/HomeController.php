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
        $user = new User();
        return User::entitiesToArray(User::getAll($user));
    }

    public function findById($id)
    {
        $user = new User();
        $user->__set('id', $id);
        return User::entitiesToArray(User::getById($user));
    }
}
