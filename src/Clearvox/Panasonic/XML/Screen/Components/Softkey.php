<?php
namespace Clearvox\Panasonic\XML\Screen\Components;
use Clearvox\Panasonic\XML\Screen\Events;

/**
 * Make a new Softkey
 *
 * @category Clearvox
 * @package Panasonic
 * @subpackage XML\Screen\Components
 * @author Bart van den Akker <bart@clearvox.nl>
 */

class Softkey
{
    /** @var string name of the softkey */
    protected $name;

    /** @var int id location of the softkey */
    protected $id;
    /**
     * @var sendRequest
     */
    protected $sendRequest = array();


    /**
     * Default contructor for a Softkey. $id determines the location (1, 2 or 3 - left, center, right)
     *
     * @param $name string Name of the Softkey (used as Text too)
     * @param $id|null int Location of the softkey
     *
     */
    public function __construct($name, $id = null)
    {
        $this->name = $name;
        $this->id = $id;
    }

    /**
     * Adds an onClicked and Sendrequest to the Softkey
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
     * @return getSendRequest
     */
    private function getSendRequests()
    {
        return $this->sendRequest;
    }

    /** Get the name of the Softkey object
     *
     * @return $this->name string
     */
    public function getName()
    {
        return $this->name;
    }

    /** Get the id (location) of the Softkey object
     *
     * @return $this->id int|null
     */
    public function getID()
    {
        return $this->id;
    }

    /**
     * Generate the DOMElement for this implementing class.
     *
     * @return \DOMElement
     */
    public function generate()
    {
        // Temporary DomDocument
        $tempDOM = new \DOMDocument();
        // Create the Element
        $softKeyElement = $tempDOM->createElement('SoftKey');

        // Loop through the sendRequests to add the Events
        foreach ($this->getSendRequests() as $onClicked) {
            // Create an Event
            $eventsElement = $tempDOM->createElement('Events');
            // Add whatever is inside the Event
            $eventsElement->appendChild($tempDOM->importNode($onClicked->generate(), true));
            // Add the whole Events object to the Softkey
            $softKeyElement->appendChild($eventsElement);
        }
        // Clean up temporary
        unset($tempDOM);
        return $softKeyElement;
    }
}