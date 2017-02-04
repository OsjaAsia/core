<?php

namespace Osja\Core\Models;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * @property integer id
 * @property integer created_by
 * @property integer updated_by
 * @property User created_who
 * @property User updated_who
 * @property Carbon created_at
 * @property Carbon updated_at
 *
 */

class BaseModel extends Model
{
    /** Attribute casting type */
    const CAST_INT = 'integer';
    const CAST_BOOL = 'boolean';
    const CAST_FLOAT = 'float';
    const CAST_DATE = 'date';
    const CAST_DATETIME = 'datetime';
    const CAST_DOUBLE='double';
    const CAST_ARRAY = 'array';

    public function __construct()
    {
        if(Auth::check()){
            $this->created_by = Auth::user()->id;
            $this->updated_by = Auth::user()->id;
        }
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function created_who()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function updated_who()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }


}
