<?php

namespace App\Models;

use CodeIgniter\Model;

class TblUsersModel extends \CodeIgniter\Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';

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
            ->countAllResults();
    }
}
