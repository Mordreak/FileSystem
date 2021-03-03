<?php


namespace Sourcecode;


class Touch extends Command
{
    public function run($arg = '')
    {
        if (!$arg) {
            echo "Impossible de créer un fichier sans nom";
            return;
        }

        $pwd = str_replace('/', '.', Prompt::getInstance()->getPwd());

        if ($pwd !== '.') {
            $pwd .= '.';
            $pwd = substr($pwd, 1, strlen($pwd));
        } else
            $pwd = '';

        file_put_contents(APP_ROOT . '/var/filesystem/' . $pwd . $arg, '');

        $currentDirectory = new Directory(Prompt::getInstance()->getPwd());
        $currentDirectory->parse();
        $files = $currentDirectory->getFiles();
        $files[] = $arg;
        $currentDirectory->setFiles($files);
    }
}
