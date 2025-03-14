<?php

namespace App\Enums;

enum TaskStatus: string
{
    case New = 'new';
    case InProgress = 'in_progress';
    case Completed = 'completed';

    public function label(): string
    {
        return match ($this) {
            TaskStatus::New => __('New'),
            TaskStatus::InProgress => __('In Progress'),
            TaskStatus::Completed => __('Completed'),
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
