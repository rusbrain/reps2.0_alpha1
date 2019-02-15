<?php

namespace App;

use App\Traits\ModelRelations\ReplayMapRelation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ReplayMap extends Model
{
    use ReplayMapRelation;
    /**
     * Using table name
     *
     * @var string
     */
    protected $table = 'replay_maps';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'url'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * @param Request $request
     * @param bool $query
     * @return bool
     */
    public static function search(Request $request, $query = false)
    {
        if (!$query){
            $query = ReplayMap::where('id', '>', 0);
        }

        if ($request->has('text') && $request->get('text')){
            $query->where(function ($q) use ($request){
                $q->where('id', 'like', "%{$request->get('text')}%")
                    ->orWhere('name', 'like', "%{$request->get('text')}%");
            });
        }

        if ($request->has('sort') && $request->get('sort')){
            $query->orderBy($request->get('sort'));
        }

        return $query;
    }
}
