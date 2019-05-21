<?php
declare(strict_types=1);

namespace DateTi\Business;

use DateTi\DateTi;

interface ShipperInterface
{
    public function getName(): string;

    public function getCurrentDate(): DateTi;

    public function setCurrentDate(DateTi $date = null);

    public function getDate(): DateTi;

    public function getDeliveryTextDate(string $format = 'Y.m.d'): string;

    public function setTime(int $hour, int $minute): void;

    public function setHour(int $hour): void;

    public function setMinute(int $minute): void;

    public function getHour(): int;

    public function getMinute(): int;

    public function enableWeekend($value = true): void;

    public function disableWeekend(): void;
}
