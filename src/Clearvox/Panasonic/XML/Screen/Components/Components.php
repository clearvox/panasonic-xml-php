<?php
namespace Clearvox\Panasonic\XML\Screen\Components;
/**
 * Make a new Menu.
 *
 * @category Clearvox
 * @package Panasonic
 * @subpackage XML\Screen\Components
 * @author Bart van den Akker <bart@clearvox.nl>
 */
use Clearvox\Panasonic\XML\Screen\ScreenXMLObjectInterface;

class Components implements ScreenXMLObjectInterface
{
    /**
     * @var softkeyItem[]
     */
    protected $softkeyItem = array();

    /**
     * Add a softKey
     *
     * @param Softkey $softKeyItem
     *
     */
    public function addSoftKey(Softkey $softKeyItem)
    {
        $this->softkeyItem[] = $softKeyItem;
    }

    /**
     * Generate the DOMElement for this implementing class.
     *
     * @return \DOMElement
     */
    public function generate()
    {
        $tempDOM = new \DOMDocument();
        $components = $tempDOM->createElement('Components');

        // Start adding Softkeys
        foreach ($this->softkeyItem as $id => $softkeyItem) {
            // Requires an ID for order
            $position = $id + 1;
            $softkeyItemElement = $softkeyItem->generate();
            // ID defines the location of a softkey
            if (!is_null($softkeyItem->getID())) {
                $softkeyItemElement->setAttribute('id', $softkeyItem->getID());
            } else {
                $softkeyItemElement->setAttribute('id', $position);
            }
            $softkeyItemElement->setAttribute('name', $softkeyItem->getName());
            $softkeyItemElement->setAttribute('text', $softkeyItem->getName());
            // Add softkeys to the Components
            $components->appendChild($tempDOM->importNode($softkeyItemElement, true));
        }

        unset($tempDOM);
        return $components;
    }
}