<?php

namespace App\Helpers;

class TimeHelper
{
    public const regex = '/^(?:[01]\d|2[0-3]):[0-5]\d$/';
    private string $time;
    private int $seconds;

    public function __construct(string | int $time)
    {
        $type = gettype($time);
        if ($type === 'string' && preg_match(self::regex, $time)) {
            $this->time = $time;
        } else if ($type === 'integer' && $time <= (24 * 3600 - 1)) {
            $this->seconds = $time;
        } else {
            throw new \Exception('wrong type of time');
        }
    }

    public function getHumanReadable(): string
    {
        if (isset($this->time)) return $this->time;

        $hours = floor($this->seconds / 3600);
        $minutes = floor(($this->seconds / 60) % 60);

        return sprintf("%02d:%02d", $hours, $minutes);
    }

    public function getDatabaseTime(): int
    {
        if (isset($this->seconds)) return $this->seconds;

        list($hours, $minutes) = explode(':', $this->time);

        return (int) $hours * 3600 + (int) $minutes * 60;
    }
}
