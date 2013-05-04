<?php

/**
 * @author Mark Wilson <mark@89allport.co.uk>
 */

namespace Tickit\CoreBundle\Entity;

use Symfony\Component\Routing\Route;

/**
 * Navigation item
 *
 * @package Tickit\CoreBundle\Entity
 */
class NavigationItem
{
    /**
     * Text to display in navigation
     *
     * @var string $text
     */
    private $text;
    /**
     * Navigation URL
     *
     * @var string $url
     */
    private $routeName;
    /**
     * Priority for item
     *
     * @var int $priority
     */
    private $priority;
    /**
     * Additional parameters for route generation
     *
     * @var array $params
     */
    private $params;
    /**
     * Generated URL
     *
     * @var string
     */
    private $url = '';

    /**
     * Create a navigation item
     *
     * @param string $text      Text to display in navigation
     * @param string $routeName Navigation URL
     * @param int    $priority  Priority for this item
     * @param array  $params    Additional paramaters for route generation
     */
    public function __construct($text, $routeName, $priority, array $params = array())
    {
        $this->text      = $text;
        $this->routeName = $routeName;
        $this->priority  = $priority;
        $this->params    = $params;
    }

    /**
     * Get text to display in navigation
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Get navigation URL
     *
     * @return string
     */
    public function getRouteName()
    {
        return $this->routeName;
    }

    /**
     * Get additional parameters
     *
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * Get navigation priority
     *
     * @return int
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set navigation URL
     *
     * @param string $url New URL
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * Get navigaiton URL
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }
}