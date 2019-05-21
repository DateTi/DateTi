<?php
declare(strict_types=1);

namespace DateTi\Configuration;

use DateTi\DateTi;
use DateTi\HolidaysInterface;

interface LocalizationInterface
{
    public function getDate(): DateTi;

    public function setLocalization(string $localization): void;

    public function getLocalization(): \DateTi\Localization\LocalizationInterface;

    public function setHolidays(string $country): void;

    public function getHolidays(): HolidaysInterface;
}
