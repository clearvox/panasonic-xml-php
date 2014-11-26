<?php
namespace Clearvox\Panasonic\XML\Screen;

/**
 * Interface ScreenXMLObjectInterface
 *
 * Implement this interface if the class should be used inside the Screen
 * element only.
 *
 * @category Clearvox
 * @package Panasonic
 * @subpackage XML\Screen
 * @author Leon Rowland <leon@rowland.nl>
 */
interface ScreenXMLObjectInterface
{
    /**
     * Generate the DOMElement for this implementing class.
     *
     * @return \DOMElement
     */
    public function generate();
}