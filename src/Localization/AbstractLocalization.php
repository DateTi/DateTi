<?php
declare(strict_types=1);

namespace DateTi\Localization;

use Galek\Utils\Calendar\Calendar;
use Galek\Utils\Calendar\Helper;
use Galek\Utils\Calendar\Validators\LocalizationValidator;
use Nette\Neon\Neon;

abstract class AbstractLocalization implements LocalizationInterface
{
    /** @var string */
    protected $local;

    /** @var array */
    protected $config;

    protected function __construct(string $local)
    {
        $this->local = $local;
    }

    public function setLocalization(string $local): void
    {
        LocalizationValidator::validate($local);
        $this->local = $local;
    }

    public function getLocalization(): string
    {
        return $this->local;
    }

    public function getInflexion($day, int $inflexion)
    {
        return $this->getInflexionDay($day)[$inflexion];
    }

    public function getDifference()
    {
        return $this->loadConfig()['difference'];
    }

    public function getAts()
    {
        return $this->loadConfig()['at'];
    }

    public function getAt($day)
    {
        return $this->getAts()[$day];
    }

    public function getTranslateDifference(Calendar $date): string
    {
        $curDate = new Calendar();
        $date = clone $date;

        $date->setTime(0, 0, 0, 0);
        $curDate->setTime(0, 0, 0, 0);

        $diff = $date->diff($curDate)->days;
        $local = $this->getDifference();

        return Helper::dateDifferenceTranslation($date, $curDate, $diff, $local);
    }

    private function getInflexionDay($day)
    {
        return $this->getInflexionDays()[$day];
    }

    private function getInflexionDays()
    {
        return $this->getInflexions()['days'];
    }

    private function getInflexions()
    {
        return $this->loadConfig()['inflexion'];
    }

    private function loadConfig()
    {
        if (!$this->config) {
            $file = __DIR__ . '/Localization/' . $this->local . '.neon';

            $this->config = Neon::decode(file_get_contents($file), Neon::BLOCK);
        }

        return $this->config;
    }
}
