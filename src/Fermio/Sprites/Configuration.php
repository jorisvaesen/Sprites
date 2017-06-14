<?php

/*
 * This file is part of the Fermio Sprites package.
 *
 * (c) Pierre Minnieur <pierre@ferm.io>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

namespace Fermio\Sprites;

use Imagine\Image\ImagineInterface;
use Imagine\Image\Palette\Color\RGB;
use Symfony\Component\Finder\Finder;

class Configuration
{
    const PROCESSOR_DYNAMIC = 'dynamic';
    const PROCESSOR_FIXED = 'fixed';

    /**
     * The ImagineInterface instance.
     *
     * @var ImagineInterface
     */
    private $imagine;

    /**
     * The save() options for the Image instance.
     *
     * @var array
     */
    private $options = array();

    /**
     * The name of the image Processor instance.
     *
     * @var string
     */
    private $processor;

    /**
     * The Finder instance.
     *
     * @var Finder
     */
    private $finder;

    /**
     * The target image path.
     *
     * @var string
     */
    private $image;

    /**
     * The Color instance.
     *
     * @var Color
     */
    private $color;

    /**
     * The fixed width per image.
     *
     * @var integer
     */
    private $width;

    /**
     * The target stylesheet path.
     *
     * @var string
     */
    private $stylesheet;

    /**
     * The CSS selector.
     *
     * @var string
     */
    private $selector = ".{{filename}}{background-position:{{x}}px {{y}}px;width:{{w}}px;height:{{h}}px}\n";

    /**
     * Returns the ImagineInterface instance.
     *
     * @return ImagineInterface
     */
    public function getImagine()
    {
        return $this->imagine;
    }

    /**
     * Sets the ImagineInterface instance.
     *
     * @param  ImagineInterface $imagine The ImagineInterface instance
     * @return void
     */
    public function setImagine(ImagineInterface $imagine)
    {
        $this->imagine = $imagine;
    }

    /**
     * Returns the save() options for the Image instance.
     *
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Sets the save() options for the Image instance.
     *
     * @param  array $options
     * @return void
     */
    public function setOptions(array $options)
    {
        $this->options = $options;
    }

    /**
     * Returns the Finder instance.
     *
     * @return Finder
     */
    public function getFinder()
    {
        if (null === $this->finder) {
            $this->finder = new Finder();
            $this->finder->files();
        }

        return $this->finder;
    }

    /**
     * Sets the Finder instance.
     *
     * @param  Finder $finder The Finder instance
     * @return void
     */
    public function setFinder(Finder $finder)
    {
        $this->finder = $finder;
    }

    /**
     * Returns the target image path.
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Sets the target image path.
     *
     * @param  string $path The target image path
     * @return void
     */
    public function setImage($path)
    {
        $this->image = $path;
    }

    /**
     * Returns the Color instance.
     *
     * @return Color
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Sets the Color instance.
     *
     * @param  Color $color The Color instance.
     * @return void
     */
    public function setColor(RGB $color)
    {
        $this->color = $color;
    }

    /**
     * Returns the name of the image ProcessorInterface instance to use.
     *
     * @return string
     */
    public function getProcessor()
    {
        if (null === $this->processor) {
            if (null !== $this->width) {
                return self::PROCESSOR_FIXED;
            }

            return self::PROCESSOR_DYNAMIC;
        }

        return $this->processor;
    }

    /**
     * Sets the name of the image ProcessorInterface instance to use.
     *
     * @param  string $name The ProcessorInterface name
     * @return void
     */
    public function setProcessor($name)
    {
        $this->processor = $name;
    }

    /**
     * Returns the fixed width per image.
     *
     * @return integer
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Sets the fixed width per image.
     *
     * @param  integer $width The fixed with per image
     * @return void
     */
    public function setWidth($width)
    {
        $this->width = $width;
    }

    /**
     * Returns the target stylesheet path.
     *
     * @return string
     */
    public function getStylesheet()
    {
        return $this->stylesheet;
    }

    /**
     * Sets the target stylesheet path.
     *
     * @param  string $path The target stylesheet path
     * @return void
     */
    public function setStylesheet($path)
    {
        $this->stylesheet = $path;
    }

    /**
     * Returns the CSS selector.
     *
     * @return string
     */
    public function getSelector()
    {
        return $this->selector;
    }

    /**
     * Sets the CSS selector.
     *
     * @param  string $selector The CSS selector
     * @return void
     */
    public function setSelector($selector)
    {
        $this->selector = $selector;
    }
}
