<?php
namespace Clearvox\Panasonic\XML\Execute;

/**
 * Interface ExecuteXMLObjectInterface
 *
 * Implement this interface if the class should be used inside the Screen
 * element only.
 *
 * @category Clearvox
 * @package Panasonic
 * @subpackage XML\Execute
 * @author Bart van den Akker <bart@clearvox.nl>
 */
interface ExecuteXMLObjectInterface
{
    /**
     * Generate the DOMElement for this implementing class.
     *
     * @return \DOMElement
     */
    public function generate();
}