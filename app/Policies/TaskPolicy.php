<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TaskPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }



    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user,  Task $task): bool
    {
        return $task->user_id === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user,  Task $task): bool
    {
        dd($user->id);
        return $task->user_id === $user->id;
    }
}
