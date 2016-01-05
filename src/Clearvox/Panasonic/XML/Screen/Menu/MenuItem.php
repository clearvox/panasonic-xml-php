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
    /* @var string name of the menuItem */
    protected $name;

    /* @var bool if it's selected or not */
    protected $selected;

    /**
     * @var sendRequest[]
     */
    protected $sendRequest = array();


    /**
     * MenuItem constructor.
     * @param $name Name of the MenuItem
     * @param bool|false $selected Is it selected
     */
    public function __construct($name, $selected = false)
    {
        $this->name = $name;
        $this->selected = $selected;
    }

    /**
     * Adds an onClick event to the Item to actually do something
     *
     * @param onClick $SendRequest
     * @return $this
     */
    public function addOnClickSendRequest(Events\onClickedSendRequest $sendRequest)
    {
        $this->sendRequest[] = $sendRequest;
        return $this;
    }

    /**
     * Adds an onClick event to the Item to actually do something
     *
     * @param onClick $SendRequest
     * @return $this
     */
    public function addOnClickDialRequest(Events\onClickedDialRequest $sendRequest)
    {
        $this->sendRequest[] = $sendRequest;
        return $this;
    }

    /**
     * Returns the request.
     *
     * @return sendRequest[]
     */
    public function getSendRequests()
    {
        return $this->sendRequest;
    }

    /**
     * Returns the name
     *
     * @return $this->name string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Is this item selected
     *
     * @return $this->selected bool
     */
    public function getSelected()
    {
        return $this->selected;
    }

    /**
     * Generate the DOMElement for this implementing class.
     *
     * @return \DOMElement
     */
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