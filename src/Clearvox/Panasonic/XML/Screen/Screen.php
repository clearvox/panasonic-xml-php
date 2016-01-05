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
     * @var string
     */
    protected $version;


    /**
     * @var XMLObjectInterface[]
     */
    protected $elements = array();

    /**
     * Default constructor
     * optional $name for name of the screen and optional version number (default=2.0)
     *
     * @param $name|null string
     * @param $version|'2.0' string
    */
    public function __construct($name = null, $version = '2.0')
    {
        $this->name = $name;
        $this->version = $version;
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


        foreach($this->elements as $element) {
            $screenElement->appendChild($tempDOM->importNode($element->generate(), true));
        }

        unset($tempDOM);
        return $screenElement;
    }
}