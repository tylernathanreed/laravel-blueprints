<?php

namespace Reedware\LaravelBlueprints\Concerns;

trait SoftDeletesBy
{
    /**
     * Alias of {@see $this->deletedBy()}.
     *
     * @param  string       $table
     * @param  string|null  $local
     * @param  string|null  $name
     * @param  string|null  $onUpdate
     * @param  string|null  $onDelete
     *
     * @return \Illuminate\Support\Fluent
     */
    public function softDeletesBy($table = null, $local = null, $name = null, $onUpdate = null, $onDelete = null)
    {
    	return $this->deletedBy($table, $local, $name, $onUpdate, $onDelete);
    }

    /**
     * Alias of {@see $this->deletedByMorph()}.
     *
     * @param  string|null  $indexName
     *
     * @return \Illuminate\Support\Fluent
     */
    public function softDeletesByMorph($indexName = null)
    {
        return $this->deletedByMorph($indexName);
    }

    /**
     * Alias of {@see $this->bigDeletedBy()}.
     *
     * @param  string       $table
     * @param  string|null  $local
     * @param  string|null  $name
     * @param  string|null  $onUpdate
     * @param  string|null  $onDelete
     *
     * @return \Illuminate\Support\Fluent
     */
    public function bigSoftDeletesBy($table = null, $local = null, $name = null, $onUpdate = null, $onDelete = null)
    {
        return $this->bigDeletedBy($table, $local, $name, $onUpdate, $onDelete);
    }

    /**
     * Alias of {@see $this->bigDeletedByMorph()}.
     *
     * @param  string|null  $indexName
     *
     * @return \Illuminate\Support\Fluent
     */
    public function bigSoftDeletesByMorph($indexName = null)
    {
        return $this->bigDeletedByMorph($indexName);
    }

    /**
     * Adds the 'deleted_by_id' Reference.
     *
     * @param  string       $table
     * @param  string|null  $local
     * @param  string|null  $name
     * @param  string|null  $onUpdate
     * @param  string|null  $onDelete
     *
     * @return \Illuminate\Support\Fluent
     */
    public function deletedBy($table = null, $local = null, $name = null, $onUpdate = null, $onDelete = null)
    {
        // Determine the Table
        if(is_null($table)) {
            $table = $this->getTimestampsByTable();
        }

        // Create the Belongs to Relation
    	return $this->belongsTo($table, 'deleted_by_id', $local, $name, $onUpdate, $onDelete)->nullable();
    }

    /**
     * Adds the 'deleted_by_id' Morph Reference.
     *
     * @param  string|null  $indexName
     *
     * @return void
     */
    public function deletedByMorph($indexName = null)
    {
        // Create the 'deleted_by_id' Morph Column
        $this->belongsToColumn('deleted_by_id')->nullable();

        // Create the 'deleted_by_type' Morph Column
        $this->string('deleted_by_type', 255)->nullable();

        // Index the two Columns
        $this->index(['deleted_by_id', 'deleted_by_type'], $indexName);
    }

    /**
     * Adds the 'deleted_by_id' Reference.
     *
     * @param  string       $table
     * @param  string|null  $local
     * @param  string|null  $name
     * @param  string|null  $onUpdate
     * @param  string|null  $onDelete
     *
     * @return void
     */
    public function bigDeletedBy($table = null, $local = null, $name = null, $onUpdate = null, $onDelete = null)
    {
        // Determine the Table
        if(is_null($table)) {
            $table = $this->getTimestampsByTable();
        }

        // Create the Belongs to Relation
        return $this->bigBelongsTo($table, 'deleted_by_id', $local, $name, $onUpdate, $onDelete)->nullable();
    }

    /**
     * Adds the 'deleted_by_id' Morph Reference.
     *
     * @param  string|null  $indexName
     *
     * @return void
     */
    public function bigDeletedByMorph($indexName = null)
    {
        // Create the 'deleted_by_id' Morph Column
        $this->bigBelongsToColumn('deleted_by_id')->nullable();

        // Create the 'deleted_by_type' Morph Column
        $this->string('deleted_by_type', 255)->nullable();

        // Index the two Columns
        $this->index(['deleted_by_id', 'deleted_by_type'], $indexName);
    }
}