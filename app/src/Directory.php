<?php


namespace Sourcecode;


class Directory
{
    protected $_pwd = null;
    protected $_name = null;
    protected $_files = null;

    public function __construct($pwd)
    {
        $this->_pwd = $pwd;
    }

    public function parse()
    {
        $pwd = $this->_pwd;
        $pwd = str_replace('/', '.', $pwd);
        $directory = fopen(APP_ROOT . '/var/filesystem/' . $pwd . '.d', 'r');
        $name = fgets($directory);
        $files = fgets($directory);

        $name = explode(':', $name);
        $files = explode(':', $files);

        $this->_name = $name[1];
        $this->_files = explode(';', $files[1]);
    }

    public function getPwd()
    {
        return $this->_pwd;
    }

    public function setPwd($pwd)
    {
        $this->_pwd = $pwd;
    }

    public function getName()
    {
        return $this->_name;
    }

    public function setName($name)
    {
        $this->_name = $name;
    }

    public function getFiles()
    {
        return $this->_files;
    }
}
