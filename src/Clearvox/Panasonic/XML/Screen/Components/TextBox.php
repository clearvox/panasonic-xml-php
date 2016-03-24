<?php
namespace Clearvox\Panasonic\XML\Screen\Components;
use Clearvox\Panasonic\XML\Screen\ScreenXMLObjectInterface;
use Clearvox\Panasonic\XML\Screen\Events;
/**
 * Make a new Label
 *
 * @category Clearvox
 * @package Panasonic
 * @subpackage XML\Screen\Components
 * @author Bart van den Akker <bart@clearvox.nl>
 */

class TextBox implements ScreenXMLObjectInterface
{
    /** @var string name of the Label */
    protected $name;

    /** @var int line of the label on the phone */
    protected $line;

    /**
     * @var text text to be shown
     */
    protected $text;


    /**
     * @var password is this a password field
     */
    protected $password;

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


    /** Get the name of the TextBox object
     *
     * @return $this->name string
     */
    public function getName()
    {
        return $this->name;
    }

    /** Get the text of the TextBox object
     *
     * @return $this->name string
     */
    public function getText()
    {
        return $this->text;
    }

    /** Get the text of the TextBox object
     *
     * @return $this->name string
     */
    public function getLine()
    {
        return $this->line;
    }

    /** Get the password value of the TextBox object
     *
     * @return $this->name string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Default contructor for a Label. $line determines the location (1, 2 or 3) and $textAlignment aligns the text
     *
     * @param $name string Name of the label (used as Text too)
     * @param $line|null int Linenr of the label
     * @param $textAlignment|null string Location of the label (left, right or center)
     *
     */
    public function __construct($name, $text, $line = 2, $password = false)
    {
        $this->name = $name;
        $this->text = $text;
        $this->line = $line;
        $this->password = $password;
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
        $textBoxElement = $tempDOM->createElement('TextBox');

        $textBoxElement->setAttribute('name',$this->name);
        $textBoxElement->setAttribute('text',$this->text);
        $textBoxElement->setAttribute('line',$this->line);

        if (true === $this->password) {
            $textBoxElement->setAttribute('password', 'true');
        } else {
            $textBoxElement->setAttribute('password', 'false');
        }


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
            $textBoxElement->appendChild($tempDOM->importNode($softkeyItemElement, true));
        }



        // Clean up temporary
        unset($tempDOM);
        //var_dump($textBoxElement);
        return $textBoxElement;
    }
}