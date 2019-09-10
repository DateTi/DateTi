<?php
declare(strict_types=1);

namespace DateTi;

use DateTi\Configuration\LocalizationInterface as LocalizationConfigurationInterface;
use DateTi\Holidays\HolidaysInterface;
use DateTi\Time\Day;
use DateTime;
use DateTimeZone;

class DateTi extends DateTime
{
    /** @var LocalizationConfigurationInterface */
	private $localizationConfiguration;


    public function __construct(string $time, DateTimeZone $timezone, LocalizationConfigurationInterface $localizationConfiguration)
    {
        parent::__construct($time, $timezone);
        $this->localizationConfiguration = $localizationConfiguration;
    }


    public function setHolidays(string $country): void
    {
        $this->localizationConfiguration->setHolidays($country);
    }


    public function getHolidays(): HolidaysInterface
    {
        return $this->localizationConfiguration->getHolidays();
    }


    public function setLocalization(string $localization)
    {
        $this->localizationConfiguration->setLocalization($localization);
        return $this;
    }


    public function getLocalization()
    {
        return $this->localizationConfiguration->getLocalization();
    }


    public function setYear($year): void
    {
        $this->setDate($year, $this->getMonth(), $this->getDay());
    }


    public function setMonth($month): void
    {
        $this->setDate($this->getYear(), $month, $this->getDay());
    }


    public function setDay($day): void
    {
        $this->setDate($this->getYear(), $this->getMonth(), $day);
    }


    public function getDay(): int
    {
        return (int) $this->format('d');
    }


    public function getMonth(): int
    {
        return (int) $this->format('m');
    }


    public function getYear(): int
    {
        return (int) $this->format('Y');
    }


    public function getHour(): int
    {
        return (int) $this->format('G');
    }


    public function getMinute(): int
    {
        return (int) $this->format('i');
    }


    public function getSecond(): int
    {
        return (int) $this->format('s');
    }


    public function isWeekend(): bool
    {
        return Day::isWeekend($this);
    }


    public function isWeekday(): bool
    {
        return Day::isWeek($this);
    }


    public function isMonday(): bool
    {
        return Day::isMonday($this);
    }


    public function isTuesday(): bool
    {
        return Day::isTuesday($this);
    }


    public function isWednesday(): bool
    {
        return Day::isWednesday($this);
    }


    public function isThursday(): bool
    {
        return Day::isThursday($this);
    }


    public function isFriday(): bool
    {
        return Day::isFriday($this);
    }


    public function isSaturday(): bool
    {
        return Day::isSaturday($this);
    }


    public function isSunday(): bool
    {
        return Day::isSunday($this);
    }


    public function isHoliday(): bool
    {
        return $this->getHolidays()->isHoliday($this);
    }


	/**
	 * @param DateTime|null $date
	 * @return bool
	 */
	public function isWorkDay(?DateTime $date = null): bool
	{
	    return Day::isWork($this->localizationConfiguration->getHolidays(), $date ?: $this);
	}
}
