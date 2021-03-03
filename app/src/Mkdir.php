<?php


namespace Sourcecode;


class Mkdir
{
    public function run($arg)
    {
        $pwd = str_replace('/', '.', Prompt::getInstance()->getPwd());

        if ($pwd == '.')
            $pwd = '';

        $data = 'name:' . Prompt::getInstance()->getPwd() . '/' . $arg .  "\n" .
            'files:' . "\n";

        file_put_contents(APP_ROOT . '/var/filesystem/' .
            $pwd . '.' .  $arg . '.d', $data);
    }
}
