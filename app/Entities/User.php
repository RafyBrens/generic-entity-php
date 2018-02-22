<?php

namespace App\Entities;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\Authenticatable;
use App\Repositories\Repository;

// class User extends Authenticatable implements EntityInterface
// {
// use BaseEntity, Notifiable;


class User implements Authenticatable, EntityInterface
{
    use BaseEntity;

    private $_fields = [
        'id',
        'name',
        'email',
        'username',
        'password'
    ];

    private $table = 'users';

    public function getTable()
    {
        return $this->table;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Gets the unique auth id of the user.
     *
     * @return integer
     */
    public function getAuthIdentifier()
    {
        return $this->id;
    }

    /**
     * Stub method of the Authenticatable interface
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Stub method of the Authenticatable interface
     */
    public function getRememberToken()
    {
        return $this->rememberMe;
    }

    /**
     * Gets the name of the unique identifier of the user.
     *
     * @return string
     */
    public function getAuthIdentifierName()
    {
        return 'id';
    }

    /**
     * Stub method of the Authenticatable interface
     */
    public function setRememberToken($value)
    {
        $this->rememberMe = $value;
        return $this;
    }

    /**
     * Stub method of the Authenticatable interface
     */
    public function getRememberTokenName()
    {
        return 'remember_me';
    }

    public static function getAll($entity)
    {
        $noPrivateFields = true;
        $results = [];

        $data = Repository::getAll($entity);
        
        foreach ($data as $result) {
            $results[] = self::prepareEntity($result, $noPrivateFields);
        }
        return $results;
    }

    public static function getById($entity)
    {
        $results = [];
        $data = Repository::getByField($entity, 'id');
        
        foreach ($data as $result) {
            $results[] = self::prepareEntity($result, true);
        }
        return $results;
    }
}
