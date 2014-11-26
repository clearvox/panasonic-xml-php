<?php
namespace Clearvox\Panasonic\XML;

/**
 * Interface XMLObjectInterface
 *
 * Implement this Interface for each component of the
 * Panasonic XML
 *
 * @category Clearvox
 * @package Panasonic
 * @subpackage XML
 * @author Leon Rowland <leon@rowland.nl>
 */
interface XMLObjectInterface
{
    /**
     * Returns the DOMElement that the implemented
     * class will generate.
     *
     * @return \DOMElement
     */
    public function generate();
}