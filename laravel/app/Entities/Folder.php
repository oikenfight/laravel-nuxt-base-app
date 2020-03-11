<?php

namespace App\Entities;

use App\Entities\Contracts\FolderInterface;
use App\Entities\Contracts\NoteInterface;
use App\Entities\Contracts\RackInterface;
use App\Entities\Contracts\UserInterface;

/**
 * Class Folder
 *
 * @package App\Entities
 * @property int $id
 * @property int $user_id
 * @property int $rack_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entities\Note[] $notes
 * @property-read int|null $notes_count
 * @property-read \App\Entities\Rack $rack
 * @property-read \App\Entities\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Folder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Folder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Folder query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Folder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Folder whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Folder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Folder whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Folder whereRackId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Folder whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Folder whereUserId($value)
 * @mixin \Eloquent
 */
class Folder extends Entity implements FolderInterface
{
    /**
     * @var string tableName
     */
    protected $table = 'folders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'user_id',
      'rack_id',
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
      'rack_id' => 'int',
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

    /**
     * @return UserInterface|\Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return RackInterface|\Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rack()
    {
        return $this->belongsTo(Rack::class);
    }

    /**
     * @return NoteInterface[]|\Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}
