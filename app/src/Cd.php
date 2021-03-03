<?php


namespace Sourcecode;


class Cd extends Command
{
    public function run($arg = '/')
    {
        $pwd = Prompt::getInstance()->getPwd();

        $pwd = str_replace('/', '.', $pwd);

        if ($pwd == '.')
            $pwd = '';

        if (!file_exists(APP_ROOT . '/var/filesystem/' . $pwd . '.' . $arg . '.d'))
            throw new \Exception('Le dossier n\'existe pas');

        $newPwd = Prompt::getInstance()->getPwd()  == '/' ?
            Prompt::getInstance()->getPwd() . $arg : Prompt::getInstance()->getPwd() . '/' . $arg;

        Prompt::getInstance()->setPwd($newPwd);
    }
}
