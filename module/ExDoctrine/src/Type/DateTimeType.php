<?php

namespace ExDoctrine\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\DateTimeType as BaseDateTimeType;
use DateTimeZone;
use DateTime;

class DateTimeType extends BaseDateTimeType
{
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if ($value instanceof DateTime) {
            $value->setTimezone($this->getDbTz());
        }
        return parent::convertToDatabaseValue($value, $platform);
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if ($value === null || $value instanceof DateTime) {
            return $value;
        }
        $dt = DateTime::createFromFormat($platform->getDateTimeFormatString(), $value, $this->getDbTz());
        if (!$dt) {
            throw ConversionException::conversionFailedFormat(
                $value,
                $this->getName(),
                $platform->getDateTimeFormatString()
            );
        }
        $dt->setTimezone($this->getAppTz());
        return $dt;
    }

    /**
     * @var DateTimeZone
     */
    private static $dbTz;

    protected function getDbTz(): DateTimeZone
    {
        if (self::$dbTz === null) {
            self::$dbTz = new DateTimeZone('UTC');
        }
        return self::$dbTz;
    }

    /**
     * @var DateTimeZone
     */
    private static $appTz;

    protected function getAppTz(): DateTimeZone
    {
        if (self::$appTz === null) {
            self::$appTz = new DateTimeZone(date_default_timezone_get());
        }
        return self::$appTz;
    }
}
