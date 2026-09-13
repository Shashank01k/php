<?php

namespace App\Models;

use CodeIgniter\Model;

class Assignment extends Model
{
     protected $table            = 'assignments';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';

    protected $allowedFields = [
        'title',
        'description',
        'technology',
        'assigned_to',
        'assigned_by',
        'created_by',
        'status',
        'is_active',
        'priority',
        'due_date',
    ];

    protected $useTimestamps = true;

    public function getAssignments(?int $userId = null): array
    {
        $builder = $this->where('is_active', 1)
            ->orderBy('created_at', 'DESC')
            ->limit(4);

        if ($userId !== null) {
            $builder->where('assigned_to', $userId);
        }

        return $builder->findAll();
    }

    public function getAssignmentsWithUsers()
    {
        return $this
            ->select('
                assignments.*,
                users.user_name AS assigned_user_name
            ')
            ->join(
                'users',
                'users.id = assignments.assigned_to',
                'left'
            )
            ->where('assignments.is_active', 1)
            ->orderBy('assignments.created_at', 'DESC');
    }

    public function getAdminAssignmentStats(int $adminId): array
    {
        $baseQuery = $this->where('is_active', 1)
            ->where('created_by', $adminId);

        return [
            'totalAssignments' => (clone $baseQuery)->countAllResults(),

            'pendingAssignments' => (clone $baseQuery)
                ->where('status', 'pending')
                ->countAllResults(),

            'completedAssignments' => (clone $baseQuery)
                ->where('status', 'completed')
                ->countAllResults(),
        ];
    }
}
