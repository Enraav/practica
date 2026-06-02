<?php

namespace src;

use src\Entity;
use src\exceptions\InvalidArgumentException;

class User extends Entity
{
    protected string $name;
    protected string $login;
    protected string $password;
    protected string $email;
    protected string $phone;
    protected string $role;
    public string $tableName = 'users';
    protected ?string $token;

    public bool $isGuest = true;
    public bool $isAdmin = false;

    public function getLogin(): string
    {
        return $this->login ?? '';
    }
    public function getName(): string
    {
        return $this->name ?? '';
    }
    public function getPhone(): string
    {
        return $this->phone ?? '';
    }
    public function getPassword(): string
    {
        return $this->password ?? '';
    }
    public function getEmail(): string
    {
        return $this->email ?? '';
    }
    public function isAdmin(): bool
    {
        return $this->role == 'admin' ? true : false;
    }

    public function loadFromForm(array $fields): void
    {
        $this->load($fields);
    }
    public function validate(): void
    {
        if (empty($this->login)) {
            throw new InvalidArgumentException('Не передан логин');
        }
        if (empty($this->password)) {
            throw new InvalidArgumentException('Не передан пароль');
        }
        if (strlen($this->password) < 6 || strlen($this->password) > 32) {
            throw new InvalidArgumentException('Пароль должен быть больше 6 символов и меньше 32 символов');
        }
        if (empty($this->name)) {
            throw new InvalidArgumentException('Не передано имя');
        }
        if (empty($this->phone)) {
            throw new InvalidArgumentException('Не передан телефон');
        }
        if (!preg_match('/^[а-яА-Я\-]+\s[а-яА-Я\-]+(\s[а-яА-Я\-]+){0,1}$/u', $this->name)) {
            throw new InvalidArgumentException('Неверный формат ФИО');
        }
        if (!preg_match('/^[а-яА-Я\s\-]+$/u', $this->name)) {
            throw new InvalidArgumentException('Неверный формат ФИО');
        }
        if (!preg_match('/^\+7\(\d{3}\)\-\d{3}\-\d{2}\-\d{2}$/', $this->phone)) {
            throw new InvalidArgumentException('Введите тел в формате +7(XXX)-XXX-XX-XX');
        }
    }
    public function save(): bool
    {
        $existingLogin = $this->findOneByColumn('login', $this->login);
        if (!empty($existingLogin)) {
            throw new InvalidArgumentException('Пользователь с таким логином уже существует');
        }
        $existingEmail = $this->findOneByColumn('email', $this->email);
        if (!empty($existingEmail)) {
            throw new InvalidArgumentException('Пользователь с таким email уже существует');
        }
        $fields = [
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'password' => $this->password,
            'login' => $this->login,
            'token' => ''
        ];
        return $this->insert($fields);
    }
    //Авторизация пользователя
    public function validateLogin(): void
    {
        if (empty($this->login)) {
            throw new InvalidArgumentException('Лоигн не может быть пустым');
        }
        if (empty($this->password)) {
            throw new InvalidArgumentException('Пароль не может быть пустым');
        }
    }
    public function login(): void
    {
        $userData = $this->findOneByColumn('login', $this->login);
        if (empty($userData)) {
            throw new InvalidArgumentException('Неверный логин или пароль');
        }
        if ($userData['password'] !== $this->password) {
            throw new InvalidArgumentException('Неверный логин или пароль');
        }
        $this->load($userData);
        $this->refreshAuthToken();
        $this->update(['token' => $this->token]);
        $this->createTokenCookie();
    }
    public function logout(): void
    {
        if ($_COOKIE['token']) {
            setcookie('token', '', -1, '/', '', false, true);
        }
    }
    public function identity(): ?array
    {
        $token = $_COOKIE['token'] ?? '';
        if (empty($token)) {
            return null;
        }
        [$userId, $authToken] = explode(':', $token, 2);
        $user = $this->getId((int) $userId);
        if ($user === null) {
            return null;
        }
        $user = $user[0];
        if (($user['token'] ?? '') !== $authToken) {
            return null;
        }
        return $user;
    }
    public function refreshAuthToken(): string
    {
        $this->token = sha1(random_bytes(100));
        return $this->token;
    }
    public function createTokenCookie(): void
    {
        $token = $this->id . ':' . $this->token;
        setcookie('token', $token, 0, '/', '', false, true);
    }
}
