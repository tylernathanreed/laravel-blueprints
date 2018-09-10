<?php

namespace Reedware\LaravelBlueprints;

use Illuminate\Support\Collection;

class Columns extends Collection
{
	/**
	 * The Table Blueprint.
	 *
	 * @var \Reed\Blueprints\Blueprint
	 */
	protected $blueprint;

    /**
     * Create a new collection of Columns.
     *
     * @param  \Reed\Blueprints\Blueprint  $blueprint
     * @param  mixed  $columns
     *
     * @return void
     */
    public function __construct($columns = [])
    {
    	// Call Parent Constructor
    	parent::__construct($columns);

    	// Set the Blueprint
    	$this->blueprint = $this->guessBlueprint();
    }

    /**
     * Returns the Table Blueprint.
     *
     * @return \Reed\Blueprints\Blueprint
     */
    public function getBlueprint()
    {
    	return $this->blueprint;
    }

    /**
     * Sets the Table Blueprint.
     *
     * @param  \Reed\Blueprints\Blueprint  $blueprint
     *
     * @return $this
     */
    public function setBlueprint(Blueprint $blueprint)
    {
    	$this->blueprint = $blueprint;

    	return $this;
    }

    /**
     * Returns the Table Blueprint using the Backtrace.
     *
     * @return \Reed\Blueprints\Blueprint|null
     */
    protected function guessBlueprint()
    {
    	// Determine the Caller
    	[$one, $two, $caller] = debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT, 3);

    	// Check for Blueprint Caller
    	if($caller['object'] instanceof Blueprint) {
    		return $caller['object'];
    	}

    	// Check for Columns Caller
    	if($caller['object'] instanceof static) {
    		return $caller['object']->getBlueprint();
    	}

    	// Unknown Caller
    	return null;
    }

    /**
     * Specifies an Index on the Columns for the Table.
     *
     * @param  string|null  $name
     * @param  string|null  $algorithm
     *
     * @return \Illuminate\Support\Fluent
     */
    public function index($name = null, $algorithm = null)
    {
        return $this->blueprint->index($this->pluck('name')->toArray(), $name, $algorithm);
    }

    /**
     * Dynamically handle calls to the class.
     *
     * @param  string  $method
     * @param  array   $parameters
     *
     * @return mixed
     */
    public function __call($method, $parameters)
    {
    	// Check for Macro
        if(static::hasMacro($method)) {
        	return parent::__call($method, $parameters);
        }

        // Call the Method on the Columns
        $this->each(function($column) use ($method, $parameters) {
        	$column->{$method}(...$parameters);
        });

        // Allow Chaining
        return $this;
    }
}