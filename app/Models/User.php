<?php

namespace App\Models;

use App\Enums\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
            'role'              => Role::class, 
        ];
    }
    
    public function roleString(): string
    {
        return $this->role instanceof Role ? $this->role->value : (string) $this->role;
    }
    
    public function getRoleValueAttribute(): string
    {
        return $this->roleString();
    }

    public function isAdmin(): bool
    {
        return $this->role === Role::ADMIN;
    }

    public function isOther(): bool
    {
        return $this->role === Role::OTHER;
    }

    public function isUser(): bool
    {
        return $this->role === Role::USER;
    }
}
