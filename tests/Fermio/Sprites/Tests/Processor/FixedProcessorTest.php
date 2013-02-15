<?php

/*
 * This file is part of the Fermio Sprites package.
 *
 * (c) Pierre Minnieur <pierre@ferm.io>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

namespace Fermio\Sprites\Tests\Processor;

use Fermio\Sprites\Configuration;
use Fermio\Sprites\Processor\FixedProcessor;
use Fermio\Sprites\Test\SpritesTestCase;

class FixedProcessorTest extends SpritesTestCase
{
    public function testProcessing()
    {
        $config = new Configuration();
        $config->setImagine($this->getImagine());
        $config->setColor($this->getColor());
        $config->setImage(sprintf('%s/icons.png', $this->path));
        $config->setStylesheet(sprintf('%s/icons.css', $this->path));
        $config->setSelector(".icon.{{filename}}{background-position:{{x}}px {{y}}px}\n");
        $config->getFinder()->name('*.png')->in(__DIR__.'/../Fixtures/icons')->sortByName();
        $config->setWidth(16);

        $processor = new FixedProcessor();
        $processor->process($config);

        $sprite = $config->getImagine()->open($config->getImage());
        $result = $config->getImagine()->open(__DIR__.'/../Fixtures/results/icons.png');
        $this->assertImageEquals($sprite, $result);
        $this->assertFileEquals(__DIR__.'/../Fixtures/results/icons.css', $config->getStylesheet());
    }

    public function testProcessingWithResizing()
    {
        $config = new Configuration();
        $config->setImagine($this->getImagine());
        $config->setColor($this->getColor());
        $config->setImage(sprintf('%s/icons_resized.png', $this->path));
        $config->setStylesheet(sprintf('%s/icons_resized.css', $this->path));
        $config->setSelector(".icon.{{filename}}{background-position:{{x}}px {{y}}px}\n");
        $config->getFinder()->name('*.png')->in(__DIR__.'/../Fixtures/icons')->sortByName();
        $config->setWidth(12);

        $processor = new FixedProcessor(array('resize' => true));
        $processor->process($config);

        $sprite = $config->getImagine()->open($config->getImage());
        $result = $config->getImagine()->open(__DIR__.'/../Fixtures/results/icons_resized.png');
        $this->assertImageEquals($sprite, $result);
        $this->assertFileEquals(__DIR__.'/../Fixtures/results/icons_resized.css', $config->getStylesheet());
    }
}
