<?php

namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $useTimestamps = false;
    protected $beforeUpdate    = [];
    protected $beforeInsert    = ['beforeInsert'];

    public const SUPER_ADMIN = 1;
    public const ADMIN       = 2;
    public const SUB_ADMIN   = 3;
    public const USER        = 4;

    protected $hidden = [
        'password',
        'temp_password',
        'deleted_at'
    ];
    protected $allowedFields = [
        'id',
        'first_name',
        'last_name',
        'user_name',
        'email',
        'phone',
        'password',
        'token',
        'user_type',
        'gender',
        'state',
        'temp_password',
        'created_at',
        'deleted_at'
    ];

    protected function beforeInsert(array $data)
    {
        $data = $this->passwordHash($data);
        $data['data']['created_at'] = date('Y-m-d H:i:s');
        return $data;
    }

    protected function beforeUpdate($data)
    {
        $data = $this->passwordHash($data);
        $data['data']['updated_at'] = date('Y-m-d H:i:s');
        return $data;
    }

    protected function passwordHash(array $data){
        if(isset($data['data']['password'])){
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }
        return $data;
    }

    public function getUserWithState($userId)
    {
        return $this->select('users.*, states.name as state_name')
            ->join('states', 'states.id = users.state', 'left')
            ->where('users.id', $userId)
            ->first();
    }
}
