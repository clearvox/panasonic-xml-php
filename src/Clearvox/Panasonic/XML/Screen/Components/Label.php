<?php
namespace Clearvox\Panasonic\XML\Screen\Components;
use Clearvox\Panasonic\XML\Screen\ScreenXMLObjectInterface;
/**
 * Make a new Label
 *
 * @category Clearvox
 * @package Panasonic
 * @subpackage XML\Screen\Components
 * @author Bart van den Akker <bart@clearvox.nl>
 */

class Label implements ScreenXMLObjectInterface
{
    /** @var string name */
    protected $name;

    /** @var int line */
    protected $line;
    /**
     * @var textAlignment
     */
    protected $textAlignment;


    /**
     * Default contructor for a Label. $line determines the location (1, 2 or 3) and $textAlignment aligns the text
     *
     * @param $name string Name of the label (used as Text too)
     * @param $line|null int Linenr of the label
     * @param $textAlignment|null int Location of the label
     *
     */
    public function __construct($name, $line = null, $textAlignment = null)
    {
        $this->name = $name;
        $this->line = $line;
        $this->textAlignment = $textAlignment;
    }

    public function generate()
    {
        // Temporary DomDocument
        $tempDOM = new \DOMDocument();
        // Create the Element
        $labelElement = $tempDOM->createElement('Label');

        $labelElement->setAttribute('name',$this->name);
        $labelElement->setAttribute('text',$this->name);
        $labelElement->setAttribute('area','Phone');
        $labelElement->setAttribute('textAlignment',$this->textAlignment);
        $labelElement->setAttribute('line',$this->line);

        // Clean up temporary
        unset($tempDOM);
        // Return the whole Softkey element
        return $labelElement;
    }
}