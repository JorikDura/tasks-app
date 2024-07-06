<?php

declare(strict_types=1);

namespace App\Enums;

enum Status: int
{
    /* Задачи или идеи, что требуют согласования перед выполнением */
    case BrainStorming = 1;
    /* Запланированные задачи */
    case Planned = 2;
    /* Задачи в работе */
    case InWork = 3;
    /* Выполненные задачи */
    case Done = 4;
    /* Отмененные задачи */
    case Canceled = 5;

    public static function getWord(self $status): string
    {
        return match ($status) {
            Status::BrainStorming => __('messages.brain_storming'),
            Status::Planned => __('messages.planned'),
            Status::InWork => __('messages.in_work'),
            Status::Done => __('messages.done'),
            Status::Canceled => __('messages.canceled'),
        };
    }
}
