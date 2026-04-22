<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
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
            'password' => 'hashed',
        ];
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function pendingTasks(): HasMany
    {
        return $this->tasks()->where('status', false);
    }

    public function completedTasks(): HasMany
    {
        return $this->tasks()->where('status', true);
    }

    public function completedTasksToday(): int
    {
        return $this->completedTasks()
            ->whereDate('completed_at', today())
            ->count();
    }

    public function getCompletionProgressAttribute(): int
    {
        $total = $this->tasks()->count();

        if ($total === 0) {
            return 0;
        }

        return (int) floor(($this->completedTasks()->count() / $total) * 100);
    }
}
