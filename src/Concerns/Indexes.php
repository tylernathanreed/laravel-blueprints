<?php

namespace Reedware\LaravelBlueprints\Concerns;

use Illuminate\Support\Str;

trait Indexes
{
    /**
     * Creates a Foreign Key for this Blueprint.
     *
     * @param  string|array  $columns
     * @param  string        $name
     *
     * @return \Illuminate\Support\Fluent
     */
    public function foreign($columns, $name = null, $on = null)
    {
    	// Index the Foreign Key
    	$index = $this->indexCommand('foreign', $columns, $name, $on);

    	// Automatically Reference ID
    	$index->references('id');

    	// Declare ON if specified
    	if(!is_null($on)) {
    		$index->on($on);
    	}

    	// Return the Index
        return $index;
    }

    /**
     * Creates a new Index on this Table.
     *
     * @param  string        $type
     * @param  string|array  $columns
     * @param  string        $index
     *
     * @return \Illuminate\Support\Fluent
     */
    protected function indexCommand($type, $columns, $index, $foreign = null)
    {
        $columns = (array) $columns;

        // If no name was specified for this index, we will create one using a basic
        // convention of the table name, followed by the columns, followed by an
        // index type, such as primary or index, which makes the index unique.
        if (is_null($index)) {
            $index = $this->createIndexName($type, $columns, $foreign);
        }

        return $this->addCommand($type, compact('index', 'columns'));
    }

    /**
     * Create a default index name for the table.
     *
     * @param  string       $type
     * @param  array        $columns
     * @param  string|null  $foreign
     *
     * @return string
     */
    protected function createIndexName($type, array $columns, $foreign = null)
    {
    	// Determine the Type Abbreviation
    	$abbreviation = $this->createIndexTypeName($type);

    	// Determine the Foreign Key Table Reference
    	if($type == 'foreign' && is_null($foreign)) {
    		$foreign = $this->createForeignIndexName($columns);
    	}

    	// Convert the Columns
    	$columns = implode('_', $columns);

    	// Determine the Index Name
    	if(isset($foreign)) {
    		$index = $abbreviation . strtolower("_{$this->table}_{$foreign}_{$columns}");
    	} else {
    		$index = $abbreviation . strtolower("_{$this->table}_{$columns}");
    	}

    	// Replace Illegal Characters
        return str_replace(['-', '.'], '_', $index);
    }

    /**
	 * Returns the Index Type Abbreviation for the specified Type.
	 *
	 * @param  string  $type
	 *
	 * @return string
     */
    protected function createIndexTypeName($type)
    {
    	// Convert Type to Abbreviation
    	switch($type) {

    		// Primary Key
    		case 'primary':
    			return 'PK';

    		// Unique Key
    		case 'unique':
    			return 'UX';

    		// Foreign Key
    		case 'foreign':
    			return 'FK';

    		// General Index
    		case 'index':
    			return 'IX';
    	}

    	// Unknown Type
    	return $type;
    }

    /**
     * Returns the Foreign Key Table Reference for the specified Columns.
     *
     * @param  array  $columns
     *
     * @return string
     */
    protected function createForeignIndexName(array $columns)
    {
    	// Initialize the List of Tables
    	$tables = [];

		// Determine the Tables being References
    	foreach($columns as $column) {

    		// Derive the Table Name from the Column
    		$table = $this->getTableNameFromColumn($column);

    		// Use the Table Name, or the Column if one couldn't be found
    		$tables[] = !is_null($table) ? $table : $column;

    	}

    	// Flatten the Array
    	return implode('_', $tables);
    }

    /**
     * Returns the Derived Table Name from the Column.
     *
     * @param  string  $column
     *
     * @return string|null
     */
    protected function getTableNameFromColumn($column)
    {
    	// Make sure the Table has an ID Suffix
    	if(!Str::endsWith($column, '_id')) {
    		return null;
    	}

    	// Strip the '_id' Suffix
    	$column = substr($column, 0, -3);

    	// Pluralize the Column Name
    	$column = Str::plural($column);

    	// Use the Plural form of the ID-less Column Name as the Table Name
    	return $column;
    }
}