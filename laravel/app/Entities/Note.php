<?php

namespace App\Entities;

use App\Entities\Contracts\FolderInterface;
use App\Entities\Contracts\ItemInterface;
use App\Entities\Contracts\NoteInterface;
use App\Entities\Contracts\UserInterface;
use Illuminate\Support\Collection;

/**
 * Class Note
 *
 * @package App\Entities
 * @property int $id
 * @property int $user_id
 * @property int $folder_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Entities\Folder $folder
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entities\Item[] $items
 * @property-read array $item_ids
 * @property-read \App\Entities\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Note newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Note newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Note query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Note whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Note whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Note whereFolderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Note whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Note whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Note whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Note whereUserId($value)
 * @mixin \Eloquent
 */
class Note extends Entity implements NoteInterface
{
    /**
     * @var string tableName
     */
    protected $table = 'notes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'folder_id',
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
        'folder_id' => 'int',
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
        'item_ids'
    ];

    /**
     * @return array
     */
    public function getItemIdsAttribute(): array
    {
        return $this->items()->get()->pluck('id')->toArray();
    }

    /**
     * @return UserInterface|\Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return FolderInterface|\Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function folder()
    {
        return $this->belongsTo(Folder::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany|Collection|ItemInterface[]
     */
    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
