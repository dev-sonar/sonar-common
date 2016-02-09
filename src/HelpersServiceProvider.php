<?php
namespace Sonar\Common;
use File;
use Illuminate\Support\ServiceProvider;

class HelpersServiceProvider extends ServiceProvider
{
    public function register()
    {
        foreach ( File::allFiles(__DIR__ . '/Helpers') as $rec ) {
            if ( preg_match("/\.php$/",$rec->getFilename()) ) {
                require_once($rec->getPathname());
            }
        }
    }
}
