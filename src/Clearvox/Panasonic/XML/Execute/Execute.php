<?php
namespace Clearvox\Panasonic\XML\Execute;

use Clearvox\Panasonic\XML\XMLObjectInterface;

/**
 * Make a new Execute
 *
 * @category Clearvox
 * @package Panasonic
 * @subpackage XML\Execute
 * @author Bart van den Akker <bart@clearvox.nl>
 */
class Execute implements XMLObjectInterface
{
    /**
     * @var XMLObjectInterface[]
     */
    protected $elements = array();


    /**
     * @param ExecuteXMLObjectInterface $element Adds a new Element to the Execute
     */
    public function addElement(ExecuteXMLObjectInterface $element)
    {
        $this->elements[] = $element;
    }

    /**
     * Returns the DOMElement that the implemented
     * class will generate.
     *
     * @return \DOMElement
     */
    public function generate()
    {
        $tempDOM = new \DOMDocument();

        $screenElement = $tempDOM->createElement('Execute');

        foreach($this->elements as $element) {
            $screenElement->appendChild($tempDOM->importNode($element->generate(), true));
        }

        unset($tempDOM);
        return $screenElement;
    }
}