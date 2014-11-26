<?php
namespace Clearvox\Panasonic\XML;

use Clearvox\Panasonic\XML\Screen\Screen;

class PanasonicPhone
{
    /**
     * @var \Clearvox\Panasonic\XML\Screen\Screen
     */
    protected $screen = null;

    public function addScreen(Screen $screen)
    {
        $this->screen = $screen;
        return $this;
    }

    public function generate()
    {
        $tempDOM = new \DOMDocument();
        $ppXML = $tempDOM->createElement('ppxml');

        $ppXML->setAttribute('xmlns', 'http://panasonic/sip_phone');
        $ppXML->setAttribute('xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance');
        $ppXML->setAttribute('xsi:schemaLocation', 'http://panasonic/sip_phone sip_phone.xsd');

        if (!is_null($this->screen)) {
            $ppXML->appendChild($tempDOM->importNode($this->screen->generate(), true));
        }

        unset($tempDOM);
        return $ppXML;
    }
}