<?php
namespace Clearvox\Panasonic\XML\Screen\PhoneBook;

/**
 * Make a new PhoneNumber. Used inside the Personnel class.
 *
 * @category Clearvox
 * @package Panasonic
 * @subpackage XML\Screen\PhoneBook
 * @author Leon Rowland <leon@rowland.nl>
 */
class PhoneNumber
{
    const EXTENSION = 'ext';
    const COMPANY   = 'company';
    const MOBILE    = 'mobile';
    const HOME      = 'home';

    /**
     * @var string
     */
    protected $number;

    /**
     * @var string
     */
    protected $type;

    /**
     * Make a new PhoneNumber for a Personnel.
     *
     * @param string $number | Max 32 digits
     * @param string $type   | Use PhoneNumber::CONST
     */
    public function __construct($number, $type)
    {
        $this->number = $number;
        $this->type   = $type;
    }

    /**
     * Return the set number
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Return the type of phone number.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return \DOMElement
     */
    public function generate()
    {
        $tempDOM = new \DOMDocument();
        $numberElement = $tempDOM->createElement('PhoneNum');

        // Build the Number element
        $numberElement->setAttribute('type', $this->type);
        $numberElement->appendChild($tempDOM->createTextNode($this->number));

        unset($tempDOM);
        return $numberElement;
    }
}