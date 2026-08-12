<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    public const ROLE_ADMIN = 'admin';

    public const ROLE_STAFF = 'staff';

    public const STATUS_ACTIVE = 'active';

    public const STATUS_INACTIVE = 'inactive';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'first_name',
        'last_name',
        'email',
        'phone',
        'role',
        'status',
        'password',
        'last_login_at',
        'password_changed_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'last_login_at' => 'datetime',
            'password_changed_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected static function booted(): void
    {
        static::saving(function (User $user): void {
            if ($user->first_name !== null || $user->last_name !== null) {
                $user->name = trim("{$user->first_name} {$user->last_name}");
            }
        });
    }

    public function fullName(): string
    {
        $name = trim("{$this->first_name} {$this->last_name}");

        return $name !== '' ? $name : (string) $this->name;
    }

    public function initials(): string
    {
        $first = strtoupper(substr((string) $this->first_name, 0, 1));
        $last = strtoupper(substr((string) $this->last_name, 0, 1));

        if ($first !== '' && $last !== '') {
            return $first.$last;
        }

        if ($first !== '') {
            return $first.strtoupper(substr((string) $this->last_name, 0, 1));
        }

        return strtoupper(substr((string) $this->name, 0, 2)) ?: 'U';
    }

    public function roleLabel(): string
    {
        return match ($this->role) {
            self::ROLE_ADMIN => 'Administrator',
            self::ROLE_STAFF => 'Museum Staff',
            default => 'Staff',
        };
    }

    public function statusLabel(): string
    {
        return match ($this->status) {
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_INACTIVE => 'Inactive',
            default => ucfirst((string) $this->status),
        };
    }

    public function isActive(): bool
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    public function passwordLastChangedLabel(): string
    {
        if ($this->password_changed_at === null) {
            return 'Not yet changed';
        }

        if ($this->password_changed_at->greaterThan(now()->subDays(30))) {
            return 'Last changed recently';
        }

        return $this->password_changed_at->format('F j, Y');
    }

    /**
     * @return array<string, string>
     */
    public function toProfileArray(): array
    {
        return [
            'name' => $this->fullName(),
            'initials' => $this->initials(),
            'role' => $this->roleLabel(),
            'email' => $this->email,
            'status' => $this->statusLabel(),
            'last_login' => $this->last_login_at?->format('F j, Y') ?? '—',
        ];
    }
}
