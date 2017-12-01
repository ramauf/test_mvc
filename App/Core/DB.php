<?php
namespace App\Core;

use App\Core\Connectors\Mysqli;

class DB
{
    public static function begin($transMode = Mysqli::TRANS_MODE_SERIALIZABLE)
    {
        return Mysqli::getInstance()->begin($transMode);
    }

    public static function commit()
    {
        return Mysqli::getInstance()->commit();
    }

    public static function rollback()
    {
        return Mysqli::getInstance()->rollback();
    }

    public static function query($query, array $params = array())
    {
        return Mysqli::getInstance()->query($query, $params);
    }

    public static function escape($str)
    {
        return Mysqli::getInstance()->escape($str);
    }

    public static function getInsId()
    {
        return Mysqli::getInstance()->getInsId();
    }
}
