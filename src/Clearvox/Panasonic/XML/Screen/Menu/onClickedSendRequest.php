<?php
namespace Clearvox\Panasonic\XML\Screen\Menu;

/**
 * Make a new onClicked event. Used inside the MenuItem class.
 *
 * @category Clearvox
 * @package Panasonic
 * @subpackage XML\Screen\Menu
 * @author Bart van den Akker <bart@clearvox.nl>
 */
class onClickedSendRequest
{
    /**
     * @var string
     */
    protected $url;

    /**
     * Make a new onClicked for a MenuItem.
     *
     * @param string $url | Max 32 digits
     */
    public function __construct($url)
    {
        $this->url = $url;
    }

    /**
     * Return the set number
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return \DOMElement
     */
    public function generate()
    {
        $tempDOM = new \DOMDocument();
        $onClickedElement = $tempDOM->createElement('OnClicked');

        $sendRequestElement = $tempDOM->createElement('SendRequest');

        // Build the onCick element
        $sendRequestElement->setAttribute('url', $this->url);
        $onClickedElement->appendChild($tempDOM->importNode($sendRequestElement, true));
        unset($tempDOM);
        return $onClickedElement;
    }
}