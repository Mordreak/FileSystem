<?php


namespace Sourcecode;


class Rm extends Command
{
    public function run($arg = '')
    {
        if (!$arg) {
            echo "Impossible de supprimer un fichier sans nom\n";
            return;
        }

        $pwd = str_replace('/', '.', Prompt::getInstance()->getPwd());

        if ($pwd !== '.') {
            $pwd .= '.';
            $pwd = substr($pwd, 1, strlen($pwd));
        } else
            $pwd = '';

        if (!file_exists(APP_ROOT . '/var/filesystem/' . $pwd . $arg)) {
            echo "Le fichier n'existe pas\n";
            return;
        }

        unlink(APP_ROOT . '/var/filesystem/' . $pwd . $arg);

        $currentDirectory = new Directory(Prompt::getInstance()->getPwd());
        $currentDirectory->parse();
        $files = $currentDirectory->getFiles();
        foreach ($files as $key => $file) {
            if ($file == $arg)
                unset($files[$key]);
        }
        $currentDirectory->setFiles($files);
    }
}
