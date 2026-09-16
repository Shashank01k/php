<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    public const SUPER_ADMIN = 1;
    public const ADMIN = 2;
    public const SUB_ADMIN = 3;
    public const USER = 4;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'user_name',
        'email',
        'password',
        'token',
        'user_type',
        'temp_password',
        'phone',
        'gender',
        'state',
        'address',
        'status',
        'created_by',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'token',
        'temp_password',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    //TODO:RND for query structure.
    public function paginateNews(int $perPage = 5, int $page = 1)
    {
        $id = (int) session('id');

        $offset = ($page - 1) * $perPage;

        return DB::table('users as u')
            ->select([
                'u.id as u_id',
                'u.user_name',
                'u.email',
                'u.phone',
                'u.gender',
                'u.created_by',
                'u.state',
                'st.name',
                'u.created_at',
                'u.updated_at',
            ])
            ->leftJoin('states as st', 'u.state', '=', 'st.id')
            ->where('st.country_id', 101)
            ->whereNull('u.deleted_at')
            ->where('u.created_by', $id)
            ->where('u.user_type', self::USER)
            ->offset($offset)
            ->limit($perPage)
            ->get();
    }

    public function getTotalCount(): int
    {
        $id = (int) session('id');

        return DB::table('users as u')
            ->leftJoin('states as st', 'u.state', '=', 'st.id')
            ->where('st.country_id', 101)
            ->whereNull('u.deleted_at')
            ->where('u.created_by', $id)
            ->where('u.user_type', self::USER)
            ->count();
    }
}
