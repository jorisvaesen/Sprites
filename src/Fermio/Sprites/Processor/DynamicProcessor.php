<?php

/*
 * This file is part of the Fermio Sprites package.
 *
 * (c) Pierre Minnieur <pierre@ferm.io>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

namespace Fermio\Sprites\Processor;

use Fermio\Sprites\Configuration;
use Imagine\Image\Box;
use Imagine\Image\Point;

class DynamicProcessor extends AbstractProcessor
{
    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'dynamic';
    }

    /**
     * {@inheritDoc}
     */
    public function process(Configuration $config)
    {
        $sprite = $config->getImagine()->create(new Box(1, 1), $config->getColor());
        $pointer = 0;
        $styles = '';
        foreach ($config->getFinder() as $file) {
            $image = $config->getImagine()->open($file->getRealPath());

            // adjust height if necessary
            $height = $sprite->getSize()->getHeight();
            if ($image->getSize()->getHeight() > $height) {
                $height = $image->getSize()->getHeight();
            }

            // copy&paste into an extended sprite
            $sprite = $config->getImagine()->create(new Box($sprite->getSize()->getWidth() + $image->getSize()->getWidth(), $height), $config->getColor())->paste($sprite, new Point(0, 0));

            // paste image into sprite
            $sprite->paste($image, new Point($pointer, 0));

            // append stylesheet code
            $styles .= $this->parseSelector($config->getSelector(), $file, $pointer, $image->getSize()->getWidth(), $image->getSize()->getHeight());

            // move horizontal cursor
            $pointer += $image->getSize()->getWidth();
        }

        $this->save($config, $sprite, $styles);
    }
}
