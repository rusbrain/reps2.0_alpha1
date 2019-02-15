<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 15.02.19
 * Time: 14:54
 */

namespace App\Traits\ModelRelations;


trait IgnoreUserRelation
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ignored_user()
    {
        return $this->belongsTo('App\User', 'ignored_user_id');
    }
}