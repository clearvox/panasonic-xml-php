<?php
namespace Clearvox\Panasonic\XML\Screen\Menu;
/**
 * Make a new MenuItem
 *
 * @category Clearvox
 * @package Panasonic
 * @subpackage XML\Screen\Menu
 * @author Bart van den Akker <bart@clearvox.nl>
 */

class Title
{
    protected $name;

    public function __construct($name)
    {
        $this->name = $name;
    }


    public function getName()
    {
        return $this->name;
    }

}