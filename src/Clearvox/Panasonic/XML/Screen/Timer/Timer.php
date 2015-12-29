<?php
namespace Clearvox\Panasonic\XML\Screen\Timer;

use Clearvox\Panasonic\XML\Screen\Events;
use Clearvox\Panasonic\XML\Screen\Events\onExpiredRequest;
/**
 * Make a new Menu.
 *
 * @category Clearvox
 * @package Panasonic
 * @subpackage XML\Screen\Components
 * @author Bart van den Akker <bart@clearvox.nl>
 */
use Clearvox\Panasonic\XML\Screen\ScreenXMLObjectInterface;

class Timer implements ScreenXMLObjectInterface
{
    /**
     * @var timerItem[]
     */
    protected $timerItem = array();

    /** @var $timer int timer in seconds*/
    protected $timer;

    /** @var  $repeat bool repeat this? */
    protected $repeat;

    /**
     * Default contructor
     *
     * @param $timer int Timeout
     * @param $repeat bool|false repeat or not.
     */
    public function __construct($timer, $repeat = false)
    {
        $this->timer = $timer;
        if (!$repeat) {
            $this->repeat = 'false';
        } else {
            $this->repeat = 'true';
        }
    }

    /**
     * Add a onExpiredRequestEvent
     *
     * @param onExpiredRequest $timeItem
     * @return $this
     *
     */
    public function addonExpiredRequestEvent(Events\onExpiredRequest $timerItem)
    {
        $this->timerItem[] = $timerItem;
        return $this;
    }

    /**
     * Generate the DOMElement for this implementing class.
     *
     * @return \DOMElement
     */
    public function generate()
    {
        $tempDOM = new \DOMDocument();
        $timer = $tempDOM->createElement('Timer');

        // Only one timer per page allowed, no use to set different names
        $timer->setAttribute('name', 'Timer1');
        $timer->setAttribute('repeat', $this->repeat);
        $timer->setAttribute('interval', $this->timer);

        // Start adding an Event
        foreach ($this->timerItem as $id => $timerItem) {
            $generatedEvent = $timerItem->generate();
            $timer->appendChild($tempDOM->importNode($generatedEvent, true));
        }


        unset($tempDOM);
        // Return the Menu
        return $timer;
    }
}