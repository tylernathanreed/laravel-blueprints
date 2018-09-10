<?php

namespace Reedware\LaravelBlueprints\Concerns;

use Reedware\LaravelBlueprints\Columns as ColumnCollection;

trait Columns
{
	/**
	 * Creates and returns a new collection of Columns.
	 *
	 * @param  mixed  $columns
	 *
	 * @return \Reed\Blueprints\Columns
	 */
	public function newColumns($columns = [])
	{
		return new ColumnCollection($columns);
	}
}