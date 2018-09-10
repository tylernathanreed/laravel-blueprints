<?php

namespace Reedware\LaravelBlueprints\Concerns;

trait Decimals
{
    /**
     * Creates the specified Money Column.
     *
     * @return \Illuminate\Support\Fluent
     */
    public function money($name)
    {
        return $this->decimal($name, $this->getConfig('money.total'), $this->getConfig('money.places'));
    }

    /**
     * Creates the specified Percent Column.
     *
     * @return \Illuminate\Support\Fluent
     */
    public function percent($name)
    {
        return $this->decimal($name, $this->getConfig('percent.total'), $this->getConfig('percent.places'));
    }
}