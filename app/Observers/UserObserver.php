<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Topic;
use App\Models\Reply;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class UserObserver
{
    public function creating(User $user)
    {
        //
    }

    public function updating(User $user)
    {
        //
    }

    public function deleted(User $user)
    {
        Reply::where('user_id', $user->id)->delete();
        Topic::where('user_id', $user->id)->delete();
    }
}
