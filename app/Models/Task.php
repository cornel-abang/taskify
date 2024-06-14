<?php

namespace App\Models;

use App\Enums\TaskStatusEnum;
use App\Scopes\CurrentUserScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $description
 * @property TaskStatusEnum<string> $status
 * @property BelongsTo<User> $user
 * @property CarbonInterface $created_at
 * @property CarbonInterface $updated_at
 */
class Task extends Model
{
    use HasFactory;

    protected $casts = [
        'status' => TaskStatusEnum::class,
    ];

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'status',
    ];

    /**
     * Scope query so users can manage ONLY their tasks
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new CurrentUserScope());
    }

    public function markAsCompleted(): bool
    {
        $this->status = TaskStatusEnum::COMPLETED;
        return $this->save();
    }

    public function markAsPending(): bool
    {
        $this->status = TaskStatusEnum::PENDING;
        return $this->save();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
