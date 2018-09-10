<?php

namespace Reedware\LaravelBlueprints\Concerns;

use Illuminate\Database\Connection;

trait ForeignKeys
{
    /**
     * Drops the specified Foreign Key if it exists.
     *
     * @param  string                           $index
     * @param  \Illuminate\Database\Connection  $connection
     *
     * @return \Illuminate\Support\Fluent|null
     */
    public function dropForeignIfExists($index, Connection $connection = null)
    {
        // Drop the Foreign Key if it exists
        if($this->foreignExists($index, $connection)) {
            return $this->dropForeign($index);
        }

        // Return NULL
        return null;
    }

    /**
     * Returns whether or not the specified Foreign Key exists.
     *
     * @param  string                           $index
     * @param  \Illuminate\Database\Connection  $connection
     *
     * @return boolean
     */
    public function foreignExists($index, Connection $connection = null)
    {
        // Determine the Foreign Keys
        $foreigns = $this->getForeignKeyNames($connection);

        // Return the the Index is in the list of Foreigns
        return in_array($index, $foreigns);
    }

    /**
     * Returns the Foreign Key names.
     *
     * @param  \Illuminate\Database\Connection  $connection
     *
     * @return array
     */
    public function getForeignKeyNames(Connection $connection = null)
    {
        // Determine the Foreign Keys
        $foreigns = $this->getForeignKeys($connection);

        // Convert them to their Names
        return array_map(function($foreign) {
            return $foreign->getName();
        }, $foreigns);
    }

    /**
     * Returns the Foreign Keys for this Table.
     *
     * @param  \Illuminate\Database\Connection|null  $connection
     *
     * @return array
     */
    public function getForeignKeys(Connection $connection = null)
    {
        // Determine the Schema Manager
        $manager = $this->getSchemaManager($connection);

        // Return the Foreign Keys
        return $manager->listTableForeignKeys($this->table);
    }
}