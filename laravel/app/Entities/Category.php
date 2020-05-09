<?php

namespace App\Entities;

use App\Entities\Contracts\CategoryInterface;
use App\Entities\Contracts\NoteInterface;
use App\Entities\Contracts\UserInterface;

/**
 * Class Category
 *
 * @package App\Entities
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entities\Note[] $notes
 * @property-read array $note_ids
 * @property-read \App\Entities\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Category whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Category whereRackId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Category whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Category whereUserId($value)
 * @mixin \Eloquent
 */
class Category extends Entity implements CategoryInterface
{
    /**
     * @var string tableName
     */
    protected $table = 'categories';

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
        // 'deleted_at',
    ];

    protected $appends = [
        'note_ids'
    ];

    /**
     * @return array
     */
    public function getNoteIdsAttribute(): array
    {
        return $this->notes()->get()->pluck('id')->toArray();
    }

    /**
     * @return UserInterface|\Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return NoteInterface[]|\Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}
