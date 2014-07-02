<?php
/**
 * @author Hone Watson
 * @email code@hone.be
 * @copyright  Copyright (c) 2013 Hone Watson
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */


namespace Hone\Csv;


class Loader
{
    /**
     * @var array
     */
    protected $headers;

    /**
     * @var string
     */
    protected $delimiter;

    /**
     * @var string
     */
    protected $enclosure;

    /**
     * @var string
     */
    protected $escape;

    /**
     * @var string
     */
    protected $type = "asArray";

    /**
     * @var string
     */
    protected $class;

    /**
     * @param string $delimiter
     * @param string $enclosure
     * @param string $escape
     */
    public function __construct($delimiter = ',', $enclosure = '"', $escape = "\\")
    {

        $this->delimiter = $delimiter;
        $this->enclosure = $enclosure;
        $this->escape = $escape;
    }

    /**
     * Sets the type of result to return for each csv row.  Could be an array, could be an object, could be a class
     * @param $type asArray|asObject|asClassnameHere
     */
    public function setType($type)
    {

        if (method_exists($this, $type))
            $this->type = $type;
        else {
            $this->type = "asClass";
            $this->class = str_replace("as", "", $type);
        }
    }

    /**
     * @param array $line row from csv
     * @return array
     */
    protected function strGetCsv($line)
    {

        return str_getcsv($line, $this->delimiter, $this->enclosure, $this->escape);
    }

    /**
     * @param array $line
     * @return array
     */
    protected function asArray($line)
    {

        return array_combine($this->headers, $this->strGetCsv($line));
    }

    /**
     * @param array $line
     * @return object
     */
    protected function asObject($line)
    {

        return (object)$this->asArray($line);
    }

    /**
     * @param $line
     * @return mixed
     */
    protected function asClass($line)
    {

        $class = $this->class;
        $line = $this->asArray($line);

        return new $class($line);
    }

    /**
     * @param $line
     * @return mixed
     */
    protected function getRow($line)
    {

        if ($this->headers === null) {
            $this->headers = $this->strGetCsv($line);

            return;
        }

        $type = $this->type;

        return $this->$type($line);
    }


    /**
     * @param string $file The path to the file.  Best to use the absolute path.
     * @return array
     */
    public function load($file)
    {

        $this->headers = null;
        $csv = array_map(array($this, 'getRow'), file($file));
        array_shift($csv);

        return $csv;
    }

} 