<?php
namespace Clearvox\Panasonic\XML\Execute;
/**
 * Reboots a Phone
 *
 * @category Clearvox
 * @package Panasonic
 * @subpackage XML\Execute
 * @author Bart van den Akker <bart@clearvox.nl>
 */

class Reboot implements ExecuteXMLObjectInterface
{
    /**
     * Generate the DOMElement for this implementing class.
     *
     * @return \DOMElement
     */
    public function generate()
    {
        // Temporary DomDocument
        $tempDOM = new \DOMDocument();
        // Create the Element
        $labelElement = $tempDOM->createElement('Reboot');

        // Clean up temporary
        unset($tempDOM);
        return $labelElement;
    }
}