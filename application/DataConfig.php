<?php

/**
 * Class DataConfig
 */
class DataConfig
{
    /**
     * @var array
     */
    protected $_data = [];

    /**
     * @var int
     */
    protected $_nextId = false;

    /**
     * @var bool|string
     */
    protected $_fileName = false;

    /**
     * @var string
     */
    protected $_fileDir = 'data/';

    /**
     * DataConfig constructor.
     * @param string $fileName file name
     */
    public function __construct($fileName)
    {
        $this->_fileName = $fileName . '.json';
        $this->read();
    }

    /**
     * read json from file
     *
     * @return array
     */
    public function read()
    {
        if (!file_exists($this->_fileDir . $this->_fileName)) {
            $handle = fopen($this->_fileDir . $this->_fileName, "w");
            fclose($handle);
        }
        $handle = fopen($this->_fileDir. $this->_fileName, 'r');
        $this->_data = fread($handle, 10000);
        fclose($handle);

        if ('' == $this->_data) {
            $this->_data = false;
            return $this->_data;
        }
        $this->_data = json_decode($this->_data, true);
        return $this->_data;
    }

    /**
     * write array to file in json format
     *
     * @param array    $data data
     * @param bool|int $id   id
     *
     * @return bool
     * @throws Exception
     */
    public function write($data, $id = false)
    {
        if (false !== $id) {
            $this->_data[$id] = $data;
        } else {
            if (is_array($this->_data) && count(array_keys($this->_data)) > 0) {
                $actualId = max(array_keys($this->_data));
            } else {
                $actualId = 1;
            }
            $nextId = $actualId + 1;
            $data['id'] = $nextId;
            $this->_data[$nextId] = $data;
            $this->_nextId = $nextId;

        }
        if (false === file_put_contents($this->_fileDir . $this->_fileName, json_encode($this->_data, JSON_PRETTY_PRINT))) {
            throw new Exception('Hiba történt a mentéskor, kérem próbálja újra');
        }
        return true;
    }

    /**
     * empty file
     *
     * @return bool
     * @throws Exception
     */
    public function emptyFile()
    {
        if (false === file_put_contents($this->_fileDir . $this->_fileName, '')) {
            throw new Exception('Hiba történt a mentéskor, kérem próbálja újra');
        }
        return true;
    }

    /**
     * get next id
     *
     * @return int
     */
    public function getNextId()
    {
        return $this->_nextId;
    }
}