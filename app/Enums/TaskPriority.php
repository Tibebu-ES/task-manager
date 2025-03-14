<?php

namespace App\Enums;

enum TaskPriority: string
{
    case Low = 'low';
    case Medium = 'medium';
    case High = 'high';

    public function label(): string{
        return match ($this) {
            TaskPriority::Low => __('Low'),
            TaskPriority::Medium => __('Medium'),
            TaskPriority::High => __('High'),
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
