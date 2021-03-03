<?php

namespace Sourcecode;

use Sourcecode\Ls;

class Prompt
{
    const COMMAND_LINE_TO_CLASS = array(
        'ls' => 'Sourcecode\Ls',
        'cd' => 'Sourcecode\Cd',
        'mkdir' => 'Sourcecode\Mkdir',
        'touch' => 'Sourcecode\Touch',
        'rm' => 'Sourcecode\Rm',
        'pwd' => 'Sourcecode\Pwd'
    );

    protected $_command = null;
    protected $_promptLine = '$ ';
    protected $_pwd = '/';

    static protected $_instance = null;

    public function __construct($promptLine = '$ ')
    {
        $this->_promptLine = $promptLine;
    }

    public function readCommand()
    {
        $this->_command = readline($this->_pwd . ' ' . $this->_promptLine);
        if (!$this->_command) {
            echo "La commande est inconnue \n";
            $this->readCommand();
        }

        readline_add_history($this->_command);

        $arg = '';

        if (strpos($this->_command , ' ') !== false) {
            $parts = explode(' ', $this->_command);
            $arg = $parts[1];
            $this->_command = $parts[0];
        }

        if (isset(self::COMMAND_LINE_TO_CLASS[$this->_command])) {
            $className = self::COMMAND_LINE_TO_CLASS[$this->_command];
            $command = new $className();
            try {
                $command->run($arg);
            } catch (\Exception $e) {
                echo $e->getMessage() . "\n";
            }
            $this->readCommand();
        } else {
            echo "La commande est inconnue \n";
            $this->readCommand();
        }
    }

    public function getPwd(): string
    {
        return $this->_pwd;
    }

    public function setPwd($pwd)
    {
        $this->_pwd = $pwd;
    }

    public static function getInstance()
    {
        if (self::$_instance === null)
            self::$_instance = new Prompt();
        return self::$_instance;
    }
}
