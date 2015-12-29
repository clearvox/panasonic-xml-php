<?php
namespace Clearvox\Panasonic\XML\Screen\Menu;
/**
 * Make a new Menu.
 *
 * @category Clearvox
 * @package Panasonic
 * @subpackage XML\Screen\Menu
 * @author Bart van den Akker <bart@clearvox.nl>
 */
use Clearvox\Panasonic\XML\Screen\ScreenXMLObjectInterface;

class Menu implements ScreenXMLObjectInterface
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var menuItem[]
     */
    protected $menuItem = array();

    /**
     * Make a new Menu. Set name
     *
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    public function addMenuItem(menuItem $menuItem)
    {
        $this->menuItem[] = $menuItem;
    }

    /**
     * Generate the DOMElement for this implementing class.
     *
     * @return \DOMElement
     */
    public function generate()
    {
        $tempDOM = new \DOMDocument();
        $menu = $tempDOM->createElement('Menu');

        if (! is_null($this->name)) {
            $menu->setAttribute('name', $this->name);
        }

        $menu->setAttribute('area', 'Phone'); // Mandatory for Menu option

        // Make MenuItems object
        $menuItems = $tempDOM->createElement('MenuItems');

        //Add all MenuItem objects into the MenuItems object
        foreach ($this->menuItem as $id => $menuItem) {
            // Requires an ID for order
            $position = $id + 1;
            $menuItemElement = $menuItem->generate();
            $menuItemElement->setAttribute('id', $position);
            $menuItemElement->setAttribute('name', $menuItem->getName());
            $menuItemElement->setAttribute('text', $menuItem->getName());
            if ($position === 1 ) {
                $menuItemElement->setAttribute('selected', 'true');
            }
            $menuItems->appendChild($tempDOM->importNode($menuItemElement, true));
        }
        // Add the whole MenuItems object to Menu
        $menu->appendChild($tempDOM->importNode($menuItems, false));

        unset($tempDOM);
        // Return the Menu
        return $menu;
    }
}