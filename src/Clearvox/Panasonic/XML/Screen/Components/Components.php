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
     * @var $textBoxItem[]
     */
    protected $textBoxItem = array();


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
     * Add a textInput
     *
     * @param Softkey $
     *
     */
    public function addTextBoxItem(TextBox $textBoxItem)
    {
        $this->textBoxItem[] = $textBoxItem;
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


        // Start adding Textbox
        foreach ($this->textBoxItem as $id => $textBoxItem) {
            // Requires an ID for order
            $position = $id + 1;
            $textBoxItemElement = $textBoxItem->generate();
            // ID defines the location of a softkey
            if (!is_null($textBoxItem->getLine())) {
                $textBoxItemElement->setAttribute('line', $textBoxItem->getLine());
            } else {
                $textBoxItemElement->setAttribute('line', $position);
            }
            $textBoxItemElement->setAttribute('name', $textBoxItem->getName());
            $textBoxItemElement->setAttribute('text', $textBoxItem->getText());

            if (true ===  $textBoxItem->getPassword()) {
                $textBoxItemElement->setAttribute('password', 'true');
            } else {
                $textBoxItemElement->setAttribute('password', 'false');
            }

            // Add softkeys to the Components
            $components->appendChild($tempDOM->importNode($textBoxItemElement, true));
        }


        unset($tempDOM);
        return $components;
    }
}