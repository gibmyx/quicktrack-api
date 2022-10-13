<?php

declare(strict_types=1);

namespace Quicktrack\User\Infrastructure\Persistence;

use Illuminate\Support\Facades\Hash;
use Quicktrack\User\Domain\Contract\UserRepository;
use Quicktrack\User\Domain\Entity\User;
use Quicktrack\User\Domain\ValueObjects\UserPassword;
use Quicktrack\User\Infrastructure\Eloquent\Models\User as ModelsUser;
use Quicktrack\User\Domain\ValueObjects\UserEmail;

final class EloquentUserRepository implements UserRepository
{
    public function find(UserEmail $userEmail): ?User
    {
        $modelsUser = ModelsUser::where('email', $userEmail->value())->first();

        if (!$modelsUser) {
            return null;
        }

        return User::fromPrimitives(
            (int)$modelsUser->id,
            $modelsUser->name,
            $modelsUser->email
        );
    }

    public function validatePasssword(User $user, UserPassword $password): bool
    {
        $modelsUser = ModelsUser::where('email', $user->email()->value())->first();
        return Hash::check($password->value(), $modelsUser->password);
    }
}
