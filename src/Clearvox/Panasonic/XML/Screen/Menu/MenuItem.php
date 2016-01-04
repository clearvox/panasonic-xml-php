<?php
namespace Clearvox\Panasonic\XML\Screen\Menu;
use Clearvox\Panasonic\XML\Screen\Events;
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

    protected $selected;

    /**
     * @var sendRequest
     */
    protected $sendRequest = array();


    public function __construct($name, $selected = false)
    {
        $this->name = $name;
        $this->selected = $selected;
    }

    /**
     * @param onClick $SendRequest
     * @return $this
     */
    public function addOnClickSendRequest(Events\onClickedSendRequest $sendRequest)
    {
        $this->sendRequest[] = $sendRequest;
        return $this;
    }

    public function addOnClickRebootRequest(Events\onClickedRebootRequest $sendRequest)
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

    public function getSelected()
    {
        return $this->selected;
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