<?php

/**
 * Class ModelAbstract
 */
abstract class ModelAbstract extends MainAbstract
{
    /**
     * @var bool
     */
    protected $_dataType = false;

    /**
     * @var bool|DataConfig
     */
    protected $_dataConfig = false;

    /**
     * save
     *
     * @return bool
     * @throws Exception
     */
    public function save()
    {
        if ('' != $this->_dataType) {
            $this->_dataConfig = new DataConfig($this->_dataType);

            return $this->_dataConfig->write($this->getData());
        } else {
            throw new Exception('Érvénytelen adattípus.');
        }
    }

    /**
     * remove all
     *
     * @return bool
     * @throws Exception
     */
    public function removeAll()
    {
        if ('' != $this->_dataType) {
            $this->_dataConfig = new DataConfig($this->_dataType);
            return $this->_dataConfig->emptyFile();
        } else {
            throw new Exception('Érvénytelen adattípus.');
        }
    }

    /**
     * get list
     *
     * @return array|void
     * @throws Exception
     */
    public function getList()
    {
        if ('' != $this->_dataType) {
            $dataConfig = new DataConfig($this->_dataType);
            return $dataConfig->read();
        } else {
            throw new Exception('Érvénytelen adattípus.');
        }
    }

    /**
     * get next id
     *
     * @return int
     */
    public function getNextId()
    {
        return $this->_dataConfig->getNextId();
    }
}