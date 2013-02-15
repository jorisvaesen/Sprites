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

interface ProcessorInterface
{
    /**
     * Processes the Configuration instance.
     *
     * @param Configration The Configuration instance
     * @return void
     */
    public function process(Configuration $config);

    /**
     * Returns the name of the Processor instance.
     *
     * @return string
     */
    public function getName();

    /**
     * Returns an options.
     *
     * @param  string $key The option key.
     * @return void
     *
     * @throws \InvalidArgumentException If the Processor does not support the option
     */
    public function getOption($key);

    /**
     * Sets an options.
     *
     * @param  string $key   The option key.
     * @param  mixed  $value The option value.
     * @return void
     *
     * @throws \InvalidArgumentException If the Processor does not support the option
     */
    public function setOption($key, $value);

    /**
     * Sets an array of options.
     *
     * @param  array $options The array of options.
     * @return void
     *
     * @throws \InvalidArgumentException If the Processor does not support an option
     */
    public function setOptions(array $options);
}
