<?php

namespace Slotegrator\Core\UseCases;

use DomainException;
use Slotegrator\Core\Entities\User\Password\DefaultPassword;
use Slotegrator\Core\Stores\UsersStore;
use Slotegrator\Core\UseCases\Auth\LoginRequest;
use Slotegrator\Core\UseCases\Auth\LoginResponse;

/**
 * class AuthService
 */
class AuthUseCase
{
    private UsersStore $users;

    public function __construct(UsersStore $users) {
        $this->users = $users;
    }

    public function byLogin(LoginRequest $request):LoginResponse {
        $validated = $request->validate();
        if ($validated->count() > 0) {
            return LoginResponse::validateErrors($validated);
        }

        $existing = $this->users->findByLoginWithPass($request->login);

        if ( ! $existing->isExisting()) {
            return LoginResponse::domain(new DomainException('Пользователь не найден либо пароль не совпадает'));
        }
        if ( ! $existing->isEqualPass(new DefaultPassword($request->pass))) {
            return LoginResponse::domain(new DomainException('Пользователь не найден либо пароль не совпадает'));
        }

        $success = LoginResponse::success();
        $success->user = $existing;
        return $success;
    }
}