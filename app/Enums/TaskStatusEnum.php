<?php

namespace App\Enums;

/**
 * I use enums so that all status managemnt (present and future) 
 * can be done from a singel point (here),
 * and it'll propagate through the system.
 */
enum TaskStatusEnum: string
{
    case PENDING = 'pending';
    case COMPLETED = 'completed';

    public function label(): string
    {
        return match($this) 
        {
            self::PENDING => 'Pending',
            self::COMPLETED => 'Completed',
        };
    }

    public function labelIcon(): string
    {
        return match($this) 
        {
            self::PENDING => 'fa-clock',
            self::COMPLETED => 'fa-check-circle',
        };
    }

    public static function toSelectOptions(): array
    {
        return [
            self::PENDING->value => self::PENDING->label(),
            self::COMPLETED->value => self::COMPLETED->label(),
        ];
    }
}