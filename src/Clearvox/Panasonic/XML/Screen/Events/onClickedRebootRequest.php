<?php
namespace Clearvox\Panasonic\XML\Screen\Events;

/**
 * Make a new onClicked event. Used inside the MenuItem class.
 *
 * @category Clearvox
 * @package Panasonic
 * @subpackage XML\Screen\Menu
 * @author Bart van den Akker <bart@clearvox.nl>
 */
class onClickedRebootRequest
{
    /**
     * Make a new onClicked for a MenuItem.
     *
     *
     */
    public function __construct()
    {
        return;
    }

    /**
     * @return \DOMElement
     */
    public function generate()
    {
        $tempDOM = new \DOMDocument();
        $onClickedElement = $tempDOM->createElement('OnClicked');
        $sendRequestElement = $tempDOM->createElement('Reboot');
        // Build the onCick element
        $onClickedElement->appendChild($tempDOM->importNode($sendRequestElement, true));
        unset($tempDOM);
        return $onClickedElement;
    }
}