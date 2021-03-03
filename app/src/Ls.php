<?php


namespace Sourcecode;

class Ls extends Command
{
    public function run($arg = '')
    {
        $pwd = Prompt::getInstance()->getPwd();
        $currentDirectory = new Directory($pwd);
        $currentDirectory->parse();
        foreach ($currentDirectory->getFiles() as $file) {
            echo $file . "\n";
        }
    }
}
