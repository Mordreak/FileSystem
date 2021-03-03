<?php


namespace Sourcecode;


class Directory
{
    protected $_pwd = null;
    protected $_name = null;
    protected $_files = null;
    protected $_directory = null;

    public function __construct($pwd)
    {
        $this->_pwd = $pwd;
    }

    public function parse()
    {
        $pwd = $this->_pwd;
        $pwd = str_replace('/', '.', $pwd);
        $this->_directory = fopen(APP_ROOT . '/var/filesystem/' . $pwd . '.d', 'r');
        $name = trim(fgets($this->_directory));
        $files = trim(fgets($this->_directory));

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

    public function setFiles($files)
    {
        $this->_files = $files;
        $this->_empty();
        $newData = 'name:' . $this->_name . "\n" .
            'files:' . implode(';', $this->_files);

        $pwd = $this->_pwd;
        $pwd = str_replace('/', '.', $pwd);

        file_put_contents(APP_ROOT . '/var/filesystem/' . $pwd . '.d', $newData);
    }

    protected function _empty()
    {
        $pwd = $this->_pwd;
        $pwd = str_replace('/', '.', $pwd);
        $file = @fopen(APP_ROOT . '/var/filesystem/' . $pwd . '.d', 'r+');
        if ($file !== false) {
            ftruncate($file, 0);
            fclose($file);
        }
    }
}
