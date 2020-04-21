<?php

namespace App\Entities;

use App\Entities\Contracts\FolderInterface;
use App\Entities\Contracts\RackInterface;
use App\Entities\Contracts\UserInterface;

/**
 * Class Rack
 *
 * @package App\Entities
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entities\Folder[] $folders
 * @property-read array $folder_ids
 * @property-read \App\Entities\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Rack newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Rack newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Rack query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Rack whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Rack whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Rack whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Rack whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Rack whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Rack whereUserId($value)
 * @mixin \Eloquent
 */
class Rack extends Entity implements RackInterface
{
    /**
     * @var string tableName
     */
    protected $table = 'racks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'user_id',
      'name',
    ];

    /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
    protected $hidden = [];

    /**
    * The attributes that should be cast to native types.
    *
    * @var array
    */
    protected $casts = [
        'user_id' => 'int',
        'name' => 'string',
    ];

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = [
        'created_at',
        'updated_at',
        //    'deleted_at',
    ];

    protected $appends = [
        'folder_ids'
    ];

    /**
     * @return array
     */
    public function getFolderIdsAttribute(): array
    {
        return $this->folders()->get()->pluck('id')->toArray();
    }

    /**
     * @return UserInterface|\Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return FolderInterface|\Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function folders()
    {
        return $this->hasMany(Folder::class);
    }
}
