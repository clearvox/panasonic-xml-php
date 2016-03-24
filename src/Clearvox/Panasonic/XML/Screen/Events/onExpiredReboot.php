<?php
namespace Clearvox\Panasonic\XML\Screen\Events;

/**
 * Make a new onExpired event.
 *
 * @category Clearvox
 * @package Panasonic
 * @subpackage XML\Screen\Events
 * @author Bart van den Akker <bart@clearvox.nl>
 */
class onExpiredReboot
{

    /**
     * @return \DOMElement
     */
    public function generate()
    {
        $tempDOM = new \DOMDocument();
        $onExpiredElement = $tempDOM->createElement('OnExpired');

        $sendRequestElement = $tempDOM->createElement('Reboot');

        // Build the onCick element
        $onExpiredElement->appendChild($tempDOM->importNode($sendRequestElement, true));
        unset($tempDOM);
        return $onExpiredElement;
    }
}