<?php
/**
 * @author Hone Watson
 * @email code@hone.be
 * @copyright  Copyright (c) 2014 Hone Watson
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */


namespace Hone\Csv\Interfaces;


interface Loader
{

    public function setFileAttributes($delimiter, $enclosure, $escape);

    public function setType($type);

    public function load($file);

} 