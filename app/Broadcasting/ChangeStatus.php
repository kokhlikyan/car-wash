<?php

namespace App\Broadcasting;

use App\Models\User;

class ChangeStatus
{
    public string $status;
    /**
     * Create a new channel instance.
     */
    public function __construct($status)
    {
        $this->status = $status;
    }

    /**
     * Authenticate the user's access to the channel.
     */
    public function join(User $user): array|bool
    {
        return true;
    }
}
