<?php
declare(strict_types=1);

namespace DateTi;

use DateTime;

interface EasterHolidayInterface
{
    public static function getMonday(int $year): DateTime;

    public static function getEaster(int $year): DateTime;

    public static function getGoodFriday(int $year): DateTime;
}
