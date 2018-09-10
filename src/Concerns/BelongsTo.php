<?php

namespace Reedware\LaravelBlueprints\Concerns;

use Illuminate\Support\Str;

trait BelongsTo
{
    /**
	 * Defines a Belongs To Column and Relationship.
	 *
     * @param  string       $table
     * @param  string|null  $foreign
     * @param  string|null  $local
     * @param  string|null  $name
     * @param  string|null  $onUpdate
     * @param  string|null  $onDelete
     *
     * @return \Illuminate\Support\Fluent
	 */
    public function belongsTo($table, $foreign = null, $local = null, $name = null, $onUpdate = null, $onDelete = null)
    {
    	// Determine the Name of the Foreign Key
    	if(is_null($foreign)) {
    		$foreign = Str::singular($table) . '_id';
    	}

    	// Define the Column
    	$column = $this->belongsToColumn($foreign);

    	// Define the Relation
    	$this->belongsToForeign($table, $foreign, $local, $name, $onUpdate, $onDelete);

    	// Return the Column
    	return $column;
    }

    /**
	 * Defines a Belongs To Column and Relationship using a Big Integer.
	 *
     * @param  string       $table
     * @param  string|null  $foreign
     * @param  string|null  $local
     * @param  string|null  $name
     * @param  string|null  $onUpdate
     * @param  string|null  $onDelete
     *
     * @return \Illuminate\Support\Fluent
	 */
    public function bigBelongsTo($table, $foreign = null, $local = null, $name = null, $onUpdate = null, $onDelete = null)
    {
    	// Determine the Name of the Foreign Key
    	if(is_null($foreign)) {
    		$foreign = Str::singular($table) . '_id';
    	}

    	// Define the Column
    	$column = $this->bigBelongsToColumn($foreign);

    	// Define the Relation
        $this->belongsToForeign($table, $foreign, $local, $name, $onUpdate, $onDelete);

    	// Return the Column
    	return $column;
    }

    /**
     * Defines a Belongs To Column.
     *
     * @param  string   $foreign
     * @param  boolean  $big
     *
     * @return \Illuminate\Support\Fluent
     */
    public function belongsToColumn($foreign, $big = false)
    {
        // Determine the Column Method
        $method = $big ? 'bigInteger' : 'integer';

        // Define the Column
        return $this->{$method}($foreign)->unsigned();
    }

    /**
     * Defines a Belongs To Column using a Big Integer.
     *
     * @param  string  $foreign
     *
     * @return \Illuminate\Support\Fluent
     */
    public function bigBelongsToColumn($foreign)
    {
        return $this->belongsToColumn($foreign, true);
    }

    /**
     * Defines a Belongs To Foreign Key.
     *
     * @param  string       $table
     * @param  string|null  $foreign
     * @param  string|null  $local
     * @param  string|null  $name
     * @param  string|null  $onUpdate
     * @param  string|null  $onDelete
     *
     * @return \Illuminate\Support\Fluent
     */
    public function belongsToForeign($table, $foreign = null, $local = null, $name = null, $onUpdate = null, $onDelete = null)
    {
        // Determine the Name of the Foreign Key
        if(is_null($foreign)) {
            $foreign = Str::singular($table) . '_id';
        }

        // Determine the Name of the Local Key
        if(is_null($local)) {
            $local = 'id';
        }

        // Determine the Update Constraint
        if(is_null($onUpdate)) {
            $onUpdate = $this->getConfig('belongsTo.onUpdate');
        }

        // Determine the Delete Constraint
        if(is_null($onDelete)) {
            $onDelete = $this->getConfig('belongsTo.onDelete');
        }

        // Define the Reference
        return $this->foreign($foreign, $name, $table)->references($local)->onUpdate($onUpdate)->onDelete($onDelete);
    }

    /**
     * Drops a Belongs To Relationship.
     *
     * @param  string       $table
     * @param  string|null  $foreign
     * @param  string|null  $local
     * @param  string|null  $name
     *
     * @return \Illuminate\Support\Fluent
     */
    public function dropBelongsTo($table, $foreign = null, $local = null, $name = null)
    {
        // Determine the Name of the Foreign Key
        if(is_null($foreign)) {
            $foreign = Str::singular($table) . '_id';
        }

        // Drop the Relation
        $this->dropBelongsToForeign($table, $foreign, $local, $name);

        // Drop the Column
        return $this->dropBelongsToColumn($foreign);
    }

    /**
     * Drops a Belongs To Column.
     *
     * @param  string  $foreign
     *
     * @return \Illuminate\Support\Fluent
     */
    public function dropBelongsToColumn($foreign)
    {
        $this->dropColumn($foreign);
    }

    /**
     * Drops a Belongs To Foreign Key.
     *
     * @param  string       $table
     * @param  string|null  $foreign
     * @param  string|null  $local
     * @param  string|null  $name
     *
     * @return \Illuminate\Support\Fluent
     */
    public function dropBelongsToForeign($table, $foreign = null, $local = null, $name = null)
    {
        // Check for a Name
        if(!is_null($name)) {
            return $this->dropForeign($name);
        }

        // Determine the Name of the Foreign Key
        if(is_null($foreign)) {
            $foreign = Str::singular($table) . '_id';
        }

        // Determine the Name of the Local Key
        if(is_null($local)) {
            $local = 'id';
        }

        // Determine the Name of the Foreign Key
        $name = $this->createIndexName('foreign', [$foreign], $table);

        // Drop the Reference
        return $this->dropForeign($name);
    }
}