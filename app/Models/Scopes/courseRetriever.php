<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class courseRetriever implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $builder->where('user_id', auth()->id());
    }
 

    // public function apply(Builder $builder, Model $model)
    // {
    //      $builder->where($model->getTable() .'.users_id', auth()->user()->users_id);
    // }
}
