<?php
namespace Clearvox\Panasonic\XML\Screen\PhoneBook;

use Clearvox\Panasonic\XML\Screen\ScreenXMLObjectInterface;

class PhoneBook implements ScreenXMLObjectInterface
{
    /**
     * @var string
     */
    protected $version;

    /**
     * @var Personnel[]
     */
    protected $personnel = array();

    /**
     * Make a new PhoneBook. Optional parameter for Version. The XML documentation
     * shows usages of "2.0"
     *
     * @param string|null $version
     */
    public function __construct($version = null)
    {
        $this->version = $version;
    }

    public function addPersonnel(Personnel $personnel)
    {
        $this->personnel[] = $personnel;
    }

    /**
     * Generate the DOMElement for this implementing class.
     *
     * @return \DOMElement
     */
    public function generate()
    {
        $tempDOM = new \DOMDocument();
        $phoneBook = $tempDOM->createElement('PhoneBook');

        if (! is_null($this->version)) {
            $phoneBook->setAttribute('version', $this->version);
        }

        foreach ($this->personnel as $id => $personnel) {
            // Requires an ID for order
            $position = $id + 1;

            $personnelElement = $personnel->generate();
            $personnelElement->setAttribute('id', $position);

            $phoneBook->appendChild($tempDOM->importNode($personnelElement, true));
        }

        unset($tempDOM);
        return $phoneBook;
    }
}