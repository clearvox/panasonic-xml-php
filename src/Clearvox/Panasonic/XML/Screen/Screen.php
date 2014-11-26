<?php
namespace Clearvox\Panasonic\XML\Screen;

use Clearvox\Panasonic\XML\XMLObjectInterface;

class Screen implements XMLObjectInterface
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var XMLObjectInterface[]
     */
    protected $elements = array();

    public function __construct($name = null)
    {
        $this->name = $name;
    }

    public function addElement(ScreenXMLObjectInterface $element)
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

        $screenElement = $tempDOM->createElement('Screen');

        // Default attributes on the Screen element
        if (! is_null($this->name)) {
            $screenElement->setAttribute('name', $this->name);
        }

        $screenElement->setAttribute('version', '2.0');

        foreach($this->elements as $element) {
            $screenElement->appendChild($tempDOM->importNode($element->generate(), true));
        }

        unset($tempDOM);
        return $screenElement;
    }
}