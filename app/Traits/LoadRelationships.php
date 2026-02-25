<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

trait LoadRelationships
{
    protected function loadRelationships(Model|Builder $target, ?array $relations=null): Model|Builder
    {
        // If $relations is not provided (null), use the default $this->relations property.
        $relations ??= $this->relations;
        foreach ($relations as $relation) {
            if ($this->includeRelation($relation)) {
                if ($target instanceof Model) {
                    $target->load($relation);
                } else {
                    $target->with($relation);
                }
            }
            /*
            $target->when(
                $this->includeRelation($relation),
                fn($q) => $target instanceof Model ? $target->load($relation) : $q->with($relation));
            */
        }
        return $target;
    }

    protected function includeRelation(string $relation): bool
    {
        // get query parameter of include from URL，then save it into string type in $include 
        $include = request()->query('include');

        if (!$include) {
            return false;
        }
        // convert from string into array
        $relations = array_map('trim', explode(',', $include));
        // compare
        return in_array($relation, $relations);
    }
}