<?php
namespace Clearvox\Panasonic\XML\Screen\Events;

/**
 * Make a new onClicked event.
 *
 * @category Clearvox
 * @package Panasonic
 * @subpackage XML\Screen\Events
 * @author Bart van den Akker <bart@clearvox.nl>
 */
class onClickedDialRequest
{
    /**
     * @var string url of the location to go to
     */
    protected $number;

    /**
     * Make a new onClicked for a MenuItem.
     *
     * @param string $number | Max 32 digits
     */
    public function __construct($number)
    {
        $this->number = $number;
    }


    /**
     * @return \DOMElement
     */
    public function generate()
    {
        $tempDOM = new \DOMDocument();
        $onClickedElement = $tempDOM->createElement('OnClicked');

        $sendRequestElement = $tempDOM->createElement('MakeCall');

        // Build the onCick element
        $sendRequestElement->setAttribute('number', $this->number);
        $onClickedElement->appendChild($tempDOM->importNode($sendRequestElement, true));
        unset($tempDOM);
        return $onClickedElement;
    }
}