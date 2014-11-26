<?php
namespace Clearvox\Panasonic\XML\Screen\PhoneBook;

class Personnel
{
    protected $name;

    /**
     * @var PhoneNumber[]
     */
    protected $numbers = array();

    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @param PhoneNumber $phoneNumber
     * @return $this
     */
    public function addNumber(PhoneNumber $phoneNumber)
    {
        $this->numbers[] = $phoneNumber;
        return $this;
    }

    /**
     * @return PhoneNumber[]
     */
    public function getNumbers()
    {
        return $this->numbers;
    }

    public function generate()
    {
        $tempDOM = new \DOMDocument();

        $personnelElement = $tempDOM->createElement('Personnel');

        // Make name element
        $nameElement = $tempDOM->createElement('Name');
        $nameElement->appendChild($tempDOM->createTextNode($this->name));

        $personnelElement->appendChild($nameElement);

        $numbersElement = $tempDOM->createElement('PhoneNums');

        foreach ($this->getNumbers() as $number) {
            $numbersElement->appendChild($tempDOM->importNode($number->generate(), true));
        }

        $personnelElement->appendChild($numbersElement);

        unset($tempDOM);
        return $personnelElement;
    }
}