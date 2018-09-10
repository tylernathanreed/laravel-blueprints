<?php

namespace Reedware\LaravelBlueprints\Concerns;

use Illuminate\Support\Str;

trait MorphsTo
{
    /**
	 * Defines a Belongs To Column and Relationship.
	 *
     * @param  string       $morphable
     * @param  string|null  $index
     *
     * @return \Reed\Blueprints\Columns
	 */
    public function morphsTo($morphable, $index = null)
    {
        // Define the ID
        $id = $this->morphsToIdColumn($morphable);

    	// Define the Type
    	$type = $this->morphsToTypeColumn($morphable);

        // Return the Columns
        return $this->newColumns([$id, $type]);
    }

    /**
	 * Defines a Belongs To Column and Relationship using a Big Integer.
	 *
     * @param  string       $morphable
     * @param  string|null  $index
     *
     * @return \Reed\Blueprints\Columns
	 */
    public function bigMorphsTo($morphable, $index = null)
    {
        // Define the ID
        $id = $this->bigMorphsToIdColumn($morphable);

        // Define the Type
        $type = $this->morphsToTypeColumn($morphable);

        // Return the Columns
        return $this->newColumns([$id, $type]);
    }

    /**
     * Defines a Morphs To ID Column.
     *
     * @param  string   $morphable
     * @param  boolean  $big
     *
     * @return \Illuminate\Support\Fluent
     */
    public function morphsToIdColumn($morphable, $big = false)
    {
        return $this->belongsToColumn($this->getMorphableId($morphable), $big);
    }

    /**
     * Defines a Big Morphs To ID Column.
     *
     * @param  string  $morphable
     *
     * @return \Illuminate\Support\Fluent
     */
    public function bigMorphsToIdColumn($morphable)
    {
        return $this->morphToIdColumn($morphable, true);
    }

    /**
     * Defines a Morphs To Type Column.
     *
     * @param  string   $morphable
     * @param  boolean  $big
     *
     * @return \Illuminate\Support\Fluent
     */
    public function morphsToTypeColumn($morphable, $big = false)
    {
        return $this->string($this->getMorphableType($morphable), 255);
    }

    /**
     * Drops a Belongs To Relationship.
     *
     * @param  string       $morphable
     * @param  string|null  $index
     *
     * @return void
     */
    public function dropMorphsTo($morphable)
    {
        // Drop the ID Column
        $this->dropMorphsToIdColumn($morphable);

        // Drop the Type Column
        $this->dropMorphsToIndex($morphable);
    }

    /**
     * Drops a Morphs To ID Column.
     *
     * @param  string  $morphable
     *
     * @return \Illuminate\Support\Fluent
     */
    public function dropMorphsToIdColumn($morphable)
    {
        $this->dropBelongsToColumn($this->getMorphableId($morphable));
    }

    /**
     * Drops a Morphs To Type Column.
     *
     * @param  string  $morphable
     *
     * @return \Illuminate\Support\Fluent
     */
    public function dropMorphsToTypeColumn($morphable)
    {
        $this->dropColumn($this->getMorphableType($morphable));
    }

    /**
     * Returns the Name of the Morphable ID Column.
     *
     * @param  string  $morphable
     *
     * @return string
     */
    public function getMorphableId($morphable)
    {
        return $morphable . '_id';
    }

    /**
     * Returns the Name of the Morphable Type Column.
     *
     * @param  string  $morphable
     *
     * @return string
     */
    public function getMorphableType($morphable)
    {
        return $morphable . '_type';
    }
}