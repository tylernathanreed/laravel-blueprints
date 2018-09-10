<?php

namespace Reedware\LaravelBlueprints\Concerns;

trait TimestampsBy
{
    /**
     * Adds the 'created_by_id' and 'updated_by_id' References.
     *
     * @param  string|null  $table
     * @param  string|null  $local
     * @param  string|null  $name
     * @param  string|null  $onUpdate
     * @param  string|null  $onDelete
     *
     * @return void
     */
    public function timestampsBy($table = null, $local = null, $name = null, $onUpdate = null, $onDelete = null)
    {
    	// Add the 'created_by_id' Reference
        $this->createdBy($table, $local, $name, $onUpdate, $onDelete);

		// Add the 'updated_by_id' Reference
        $this->updatedBy($table, $local, $name, $onUpdate, $onDelete);
    }

    /**
     * Adds the 'created_by_id' and 'updated_by_id' Morph References.
     *
     * @param  string|null  $indexName
     *
     * @return void
     */
    public function timestampsByMorph($indexName = null)
    {
        // Add the 'created_by_id' Reference
        $this->createdByMorph($indexName);

        // Add the 'updated_by_id' Reference
        $this->updatedByMorph($indexName);
    }

    /**
     * Adds the 'created_by_id' and 'updated_by_id' References.
     *
     * @param  string       $table
     * @param  string|null  $local
     * @param  string|null  $name
     * @param  string|null  $onUpdate
     * @param  string|null  $onDelete
     *
     * @return void
     */
    public function bigTimestampsBy($table = null, $local = null, $name = null, $onUpdate = null, $onDelete = null)
    {
        // Add the 'created_by_id' Reference
        $this->bigCreatedBy($table, $local, $name, $onUpdate, $onDelete);

        // Add the 'updated_by_id' Reference
        $this->bigUpdatedBy($table, $local, $name, $onUpdate, $onDelete);
    }

    /**
     * Adds the 'created_by_id' and 'updated_by_id' Morph References.
     *
     * @param  string|null  $indexName
     *
     * @return void
     */
    public function bigTimestampsByMorph($indexName = null)
    {
        // Add the 'created_by_id' Reference
        $this->bigCreatedByMorph($indexName);

        // Add the 'updated_by_id' Reference
        $this->bigUpdatedByMorph($indexName);
    }

    /**
     * Adds the 'created_by_id' Reference.
     *
     * @param  string       $table
     * @param  string|null  $local
     * @param  string|null  $name
     * @param  string|null  $onUpdate
     * @param  string|null  $onDelete
     *
     * @return \Illuminate\Support\Fluent
     */
    public function createdBy($table = null, $local = null, $name = null, $onUpdate = null, $onDelete = null)
    {
        // Determine the Table
        if(is_null($table)) {
            $table = $this->getTimestampsByTable();
        }

        // Create the Belongs to Relation
    	return $this->belongsTo($table, 'created_by_id', $local, $name, $onUpdate, $onDelete)->nullable();
    }

    /**
     * Adds the 'created_by_id' Morph Reference.
     *
     * @param  string  $indexName
     *
     * @return \Illuminate\Support\Fluent
     */
    public function createdByMorph($indexName = null)
    {
        // Create the 'created_by_id' Morph Column
        $this->belongsToColumn('created_by_id')->nullable();

        // Create the 'created_by_type' Morph Column
        $this->string('created_by_type', 255)->nullable();

        // Index the two Columns
        $this->index(['created_by_id', 'created_by_type'], $indexName);
    }

    /**
     * Adds the 'created_by_id' Reference.
     *
     * @param  string       $table
     * @param  string|null  $local
     * @param  string|null  $name
     * @param  string|null  $onUpdate
     * @param  string|null  $onDelete
     *
     * @return \Illuminate\Support\Fluent
     */
    public function bigCreatedBy($table = null, $local = null, $name = null, $onUpdate = null, $onDelete = null)
    {
        // Determine the Table
        if(is_null($table)) {
            $table = $this->getTimestampsByTable();
        }

        // Create the Belongs to Relation
        return $this->bigBelongsTo($table, 'created_by_id', $local, $name, $onUpdate, $onDelete)->nullable();
    }

    /**
     * Adds the 'created_by_id' Morph Reference.
     *
     * @param  string  $indexName
     *
     * @return \Illuminate\Support\Fluent
     */
    public function bigCreatedByMorph($indexName = null)
    {
        // Create the 'created_by_id' Morph Column
        $this->bigBelongsToColumn('created_by_id')->nullable();

        // Create the 'created_by_type' Morph Column
        $this->string('created_by_type', 255)->nullable();

        // Index the two Columns
        $this->index(['created_by_id', 'created_by_type'], $indexName);
    }

    /**
     * Adds the 'updated_by_id' Reference.
     *
     * @param  string       $table
     * @param  string|null  $local
     * @param  string|null  $name
     * @param  string|null  $onUpdate
     * @param  string|null  $onDelete
     *
     * @return \Illuminate\Support\Fluent
     */
    public function updatedBy($table = null, $local = null, $name = null, $onUpdate = null, $onDelete = null)
    {
        // Determine the Table
        if(is_null($table)) {
            $table = $this->getTimestampsByTable();
        }

        // Create the Belongs to Relation
    	return $this->belongsTo($table, 'updated_by_id', $local, $name, $onUpdate, $onDelete)->nullable();
    }

    /**
     * Adds the 'updated_by_id' Morph Reference.
     *
     * @param  string  $indexName
     *
     * @return \Illuminate\Support\Fluent
     */
    public function updatedByMorph($indexName = null)
    {
        // Create the 'updated_by_id' Morph Column
        $this->belongsToColumn('updated_by_id')->nullable();

        // Create the 'updated_by_type' Morph Column
        $this->string('updated_by_type', 255)->nullable();

        // Index the two Columns
        $this->index(['updated_by_id', 'updated_by_type'], $indexName);
    }

    /**
     * Adds the 'updated_by_id' Reference.
     *
     * @param  string       $table
     * @param  string|null  $local
     * @param  string|null  $name
     * @param  string|null  $onUpdate
     * @param  string|null  $onDelete
     *
     * @return \Illuminate\Support\Fluent
     */
    public function bigUpdatedBy($table = null, $local = null, $name = null, $onUpdate = null, $onDelete = null)
    {
        // Determine the Table
        if(is_null($table)) {
            $table = $this->getTimestampsByTable();
        }

        // Create the Belongs to Relation
        return $this->bigBelongsTo($table, 'updated_by_id', $local, $name, $onUpdate, $onDelete)->nullable();
    }

    /**
     * Adds the 'updated_by_id' Morph Reference.
     *
     * @param  string  $indexName
     *
     * @return \Illuminate\Support\Fluent
     */
    public function bigUpdatedByMorph($indexName = null)
    {
        // Create the 'updated_by_id' Morph Column
        $this->bigBelongsToColumn('updated_by_id')->nullable();

        // Create the 'updated_by_type' Morph Column
        $this->string('updated_by_type', 255)->nullable();

        // Index the two Columns
        $this->index(['updated_by_id', 'updated_by_type'], $indexName);
    }

    /**
     * Returns the Table used for Timestamps By Relations.
     *
     * @return string
     */
    public function getTimestampsByTable()
    {
        // Determine the default Timestamps By Model
        $model = $this->getConfig('timestampsBy.model');

        // Create a new Model instance
        $instance = new $model;

        // Return the Table
        return $instance->getTable();
    }
}