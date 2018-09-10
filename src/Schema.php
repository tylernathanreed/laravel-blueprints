<?php

namespace Reedware\LaravelBlueprints;

use Illuminate\Support\Facades\Schema as BaseFacade;

/**
 * @see \Illuminate\Database\Schema\Builder
 */
class Schema extends BaseFacade
{
    /**
     * Returns a new schema builder instance for the specified connection.
     *
     * @param  string  $name
     *
     * @return \Illuminate\Database\Schema\Builder
     */
    public static function connection($name)
    {
    	// Create the schema builder
        $schema = parent::connection($name);

        // Use the custom blueprint
        $schema->blueprintResolver(function($table, $callback) {
        	return new Blueprint($table, $callback);
        });

        // Return the schema
        return $schema;
    }

    /**
     * Returns a new schema builder instance for the default connection.
     *
     * @return \Illuminate\Database\Schema\Builder
     */
    protected static function getFacadeAccessor()
    {
    	// Create the schema builder
        $schema = parent::getFacadeAccessor();

        // Use the custom blueprint
        $schema->blueprintResolver(function($table, $callback) {
        	return new Blueprint($table, $callback);
        });

        // Return the schema
        return $schema;
    }
}
