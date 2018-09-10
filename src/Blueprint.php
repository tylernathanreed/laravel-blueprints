<?php

namespace Reedware\LaravelBlueprints;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Connection;
use Illuminate\Database\Schema\Blueprint as TableBlueprint;

class Blueprint extends TableBlueprint
{
    use Concerns\Columns,
        Concerns\BelongsTo,
        Concerns\MorphsTo,
        Concerns\Decimals,
        Concerns\ForeignKeys,
        Concerns\TimestampsBy,
        Concerns\SoftDeletesBy,
        Concerns\Indexes;

    /**
     * Returns the Schema Manager for the specified Connection.
     *
     * @param  \Illuminate\Database\Connection  $connection
     *
     * @return \Doctrine\DBAL\Schema\AbstractSchemaManager
     */
    public function getSchemaManager(Connection $connection = null)
    {
        // Determine the Connection
        $connection = $connection ?: DB::connection();

        // Return the Schema Manager
        return $connection->getDoctrineSchemaManager();
    }

    /**
     * Returns the specified Configuration Value.
     *
     * @param  string|null  $key
     * @param  mixed        $value
     *
     * @return mixed
     */
    public function getConfig($key = null, $value = null)
    {
        return Arr::get(config('blueprints'), $key, $value);
    }
}