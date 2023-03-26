<?php

/**
 * Description of UniqueNoHelper
 *
 * @author enxil
 */
class UniqueNoHelper {
    public static function RandomCode($prefix) {
        $dt = new DateTime("now", new DateTimeZone('Asia/Kuala_Lumpur'));
        $dt = $dt->format("Y/my/H:i:s.u ");
        return $prefix.$dt;
    }
}
