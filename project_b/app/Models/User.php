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
        'created_by',
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

    public function getAdminUserCount(int $adminId): int
    {
        return (new \App\Models\User())
            ->where('created_by', $adminId)
            ->countAllResults();
    }

    public function paginateNews(int $perPage = 5, int $page = 1)
    {
        $offset = ($page - 1) * $perPage;

        $builder = $this->db->table('users AS u');

        $query = $builder
            ->select(
                'u.id AS u_id,
                u.user_name,
                u.email,
                u.phone,
                u.gender,
                u.created_by,
                u.state,
                st.name,
                u.created_at,
                u.updated_at'
            )
            ->join('states AS st', 'u.state = st.id', 'left')
            ->where('st.country_id', 101)
            ->where('u.deleted_at', null)
            ->where('u.deleted_at', null)
            ->where('user_type', User::USER)
            ->limit($perPage, $offset)
            ->get();

        return $query->getResult();
    }

    /**
     * Summary of getTotalCount
     * @return int|string
     */
    public function getTotalCount()
    {
        $builder = $this->db->table('users AS u');

        return $builder
            ->join('states AS st', 'u.state = st.id', 'left')
            ->where('st.country_id', 101)
            ->where('u.deleted_at', null)
            ->where('user_type', User::USER)
            ->countAllResults();
    }
}
