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
class onExpiredRequest
{
    /**
     * @var string url to go to.
     */
    protected $url;


    /**
     * Make a new onExpired object
     *
     * @param string $url Max 32 digits
     * @param int $timer In seconds
     */
    public function __construct($url)
    {
        $this->url = $url;
    }


    /**
     * @return \DOMElement
     */
    public function generate()
    {
        $tempDOM = new \DOMDocument();
        $onExpiredElement = $tempDOM->createElement('OnExpired');

        $sendRequestElement = $tempDOM->createElement('SendRequest');

        // Build the onCick element
        $sendRequestElement->setAttribute('url', $this->url);
        $onExpiredElement->appendChild($tempDOM->importNode($sendRequestElement, true));
        unset($tempDOM);
        return $onExpiredElement;
    }
}