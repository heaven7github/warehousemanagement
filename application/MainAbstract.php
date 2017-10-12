<?php

/**
 * Class MainAbstract
 */
abstract class MainAbstract
{
    /**
     * Setter/Getter underscore transformation cache
     *
     * @var array
     */
    protected static $_underscoreCache = array();

    /**
     * constructor.
     * @param string $type type
     */
    public function __construct($type = '')
    {
        // if type is simulation, we need to change dataType
        if ($type == 'simulation') {
            $this->_dataType = 'simulation/' . $this->_dataType;
        }
    }

    /**
     * Set/Get attribute wrapper
     *
     * @param   string $method method
     * @param   array  $args   args
     * @return  mixed
     */
    public function __call($method, $args)
    {
        switch (substr($method, 0, 3)) {
            case 'get' :
                $key = $this->_underscore(substr($method, 3));
                $data = $this->getData($key, isset($args[0]) ? $args[0] : null);
                return $data;

            case 'set' :
                $key = $this->_underscore(substr($method, 3));
                $result = $this->setData($key, isset($args[0]) ? $args[0] : null);
                return $result;

        }
        echo 'Érvénytelen metódus' . get_class($this) . "::" . $method . "(".print_r($args, 1).")";
        exit;
    }

    /**
     * Converts field names for setters and geters
     *
     * $this->setMyField($value) === $this->setData('my_field', $value)
     * Uses cache to eliminate unneccessary preg_replace
     *
     * @param string $name name
     * @return string
     */
    protected function _underscore($name)
    {
        if (isset(self::$_underscoreCache[$name])) {
            return self::$_underscoreCache[$name];
        }

        $result = strtolower(preg_replace('/(.)([A-Z])/', "$1_$2", $name));
        self::$_underscoreCache[$name] = $result;
        return $result;
    }

    /**
     *
     * If $key is string, the attribute value will be overwritten by $value
     *
     * @param string $key   key
     * @param mixed  $value value
     * @return object
     */
    public function setData($key, $value = null)
    {
        $this->_data[$key] = $value;
        return $this;
    }

    /**
     * Retrieves data from the object
     *
     * If $key is empty will return all the data as an array
     * Otherwise it will return value of the attribute specified by $key
     *
     * @param string $key key
     * @return mixed
     */
    public function getData($key = '')
    {
        if (''===$key) {
            return $this->_data;
        }

        if (isset($this->_data[$key])) {
            return $this->_data[$key];
        }
        return null;
    }
}