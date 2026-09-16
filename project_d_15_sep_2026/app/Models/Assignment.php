<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $fillable = [
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

    public function getAdminAssignmentStats(int $id): array
    {
        $baseQuery = $this->newQuery()
            ->where('is_active', 1)
            ->where('created_by', $id);

        return [
            'totalAssignments' => (clone $baseQuery)
                ->count(),

            'pendingAssignments' => (clone $baseQuery)
                ->where('status', 'pending')
                ->count(),

            'completedAssignments' => (clone $baseQuery)
                ->where('status', 'completed')
                ->count(),
        ];
    }

    public function getAssignments(?int $userId = null): array
    {
        $query = $this->newQuery()
            ->where('is_active', 1)
            ->orderBy('created_at', 'desc')
            ->limit(4);

        if ($userId !== null) {
            $query->where('created_by', $userId);
        }

        return $query->get()
            ->toArray();
    }
}
