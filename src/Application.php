<?php

namespace src;

use src\exceptions\InvalidArgumentException;

class Application extends Entity
{
    protected int $user_id;
    protected string $reason;
    protected string $text;
    protected string $date;
    protected string $time;
    protected string $created_at;
    protected string $status;

    public string $tableName = 'application';

    public function validate(): void
    {
        date_default_timezone_set('Europe/Moscow');

        if (empty($this->reason)) {
            throw new InvalidArgumentException(
                'Не указана причина обращения'
            );
        }

        if (empty($this->text)) {
            throw new InvalidArgumentException(
                'Не указано описание'
            );
        }

        if (empty($this->date)) {
            throw new InvalidArgumentException(
                'Не указана дата'
            );
        }

        if (empty($this->time)) {
            throw new InvalidArgumentException(
                'Не указано время'
            );
        }

        $date = \DateTime::createFromFormat(
            'Y-m-d',
            $this->date
        );

        if (
            !$date ||
            $date->format('Y-m-d') !== $this->date
        ) {
            throw new InvalidArgumentException(
                'Некорректная дата'
            );
        }

        $time = \DateTime::createFromFormat(
            'H:i',
            $this->time
        );

        if (
            !$time ||
            $time->format('H:i') !== $this->time
        ) {
            throw new InvalidArgumentException(
                'Некорректное время'
            );
        }

        $currentDate = date('Y-m-d');

        if ($this->date < $currentDate) {
            throw new InvalidArgumentException(
                'Нельзя выбрать прошедшую дату'
            );
        }
    }

    public function saveApplication(int $user_id): bool
    {
        $fields = [
            'user_id' => $user_id,
            'reason' => $this->reason,
            'text' => $this->text,
            'date' => $this->date,
            'time' => $this->time,
            'status_id' => '1'
        ];

        return $this->insert($fields);
    }
}
