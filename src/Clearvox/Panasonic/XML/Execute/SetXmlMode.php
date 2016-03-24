<?php
namespace Clearvox\Panasonic\XML\Execute;
/**
 * Make a new SetXmlMode
 *
 * @category Clearvox
 * @package Panasonic
 * @subpackage XML\Execute
 * @author Bart van den Akker <bart@clearvox.nl>
 */

class SetXmlMode implements ExecuteXMLObjectInterface
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
        $setXmlElement = $tempDOM->createElement('SetXmlMode');
        $setXmlElement->setAttribute('mode','on');

        // Clean up temporary
        unset($tempDOM);
        return $setXmlElement;
    }
}