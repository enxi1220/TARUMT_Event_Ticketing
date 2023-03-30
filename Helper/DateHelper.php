<?php

/**
 * Description of DateHelper
 *
 * @author enxil
 */
class DateHelper
{
    public static function GetMalaysiaDateTime()
    {
        $dt = new DateTime("now", new DateTimeZone('Asia/Kuala_Lumpur'));
        return $dt->format("Y-m-d H:i:s");
    }
}
