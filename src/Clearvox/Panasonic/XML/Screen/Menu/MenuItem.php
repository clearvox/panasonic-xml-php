<?php
namespace Clearvox\Panasonic\XML\Screen\Menu;
/**
 * Make a new MenuItem
 *
 * @category Clearvox
 * @package Panasonic
 * @subpackage XML\Screen\Menu
 * @author Bart van den Akker <bart@clearvox.nl>
 */

class MenuItem
{
    protected $name;

    /**
     * @var sendRequest
     */
    protected $sendRequest = array();


    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @param onClick $SendRequest
     * @return $this
     */
    public function addOnClickSendRequest(onClickedSendRequest $sendRequest)
    {
        $this->sendRequest[] = $sendRequest;
        return $this;
    }

    public function addOnClickRebootRequest(onClickedRebootRequest $sendRequest)
    {
        $this->sendRequest[] = $sendRequest;
        return $this;
    }

    /**
     * @return PhoneNumber[]
     */
    public function getSendRequests()
    {
        return $this->sendRequest;
    }

    public function getName()
    {
        return $this->name;
    }

    public function generate()
    {
        $tempDOM = new \DOMDocument();

        $menuItemsElement = $tempDOM->createElement('MenuItem');

        foreach ($this->getSendRequests() as $onClicked) {
            $eventsElement = $tempDOM->createElement('Events');
            $eventsElement->appendChild($tempDOM->importNode($onClicked->generate(), true));
            $menuItemsElement->appendChild($eventsElement);
        }

        unset($tempDOM);
        return $menuItemsElement;
    }
}