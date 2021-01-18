<?php

namespace LaravelEnso\Core\Http\Controllers\Administration\User;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;
use LaravelEnso\Core\Models\User;
use LaravelEnso\Core\Services\ProfileBuilder;

class Show extends Controller
{
    use AuthorizesRequests;

    public function __invoke(User $user)
    {
        $this->authorize('profile', $user);

        (new ProfileBuilder($user))->set();

        return ['user' => $user];
    }
}
