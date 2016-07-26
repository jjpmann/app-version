<?php

namespace AppVersion;

use Composer\Script\Event;

class Version
{
    public static function echoCurrent(Event $event)
    {
        echo self::current($event);
    }

    public static function echoPrevious(Event $event)
    {
        echo self::previous($event);
    }

    public static function current(Event $event)
    {
        $extra = $event->getComposer()->getPackage()->getExtra();

        return $extra['version'];
    }

    public static function previous(Event $event)
    {
        $extra = $event->getComposer()->getPackage()->getExtra();
        echo $extra['previous'];
    }

    public static function test()
    {
        echo 'test';
    }
}
