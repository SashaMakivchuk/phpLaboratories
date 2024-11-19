<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;

class ProjectPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function manageAll(User $user): bool
    {
        return $user->role === 'Superadmin';
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Project $project): bool
    {
        return $user->id === $project->creator_user_id || $user->role === 'editor';
    }

    public function delete(User $user, Project $project): bool
    {
        return $user->role === 'Superadmin' || $user->id === $project->creator_user_id;
    }
}
