<?php

namespace App\Entities;

use App\Entities\Contracts\ItemInterface;
use App\Entities\Contracts\NoteInterface;
use App\Entities\Contracts\UserInterface;

/**
 * Class Item
 *
 * @package App\Entities
 * @property int $id
 * @property int $user_id
 * @property int $note_id
 * @property string $body
 * @property int $order_index
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Entities\Note $note
 * @property-read \App\Entities\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Item newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Item newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Item query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Item whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Item whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Item whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Item whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Item whereNoteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Item whereOrderIndex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Item whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Item whereUserId($value)
 * @mixin \Eloquent
 */
class Item extends Entity implements ItemInterface
{
    /**
     * @var string tableName
     */
    protected $table = 'items';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'user_id',
      'note_id',
      'body',
      'order_index'
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
      'note_id' => 'int',
      'body' => 'string',
      'order_index' => 'int'
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
     * @return NoteInterface|\Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function note()
    {
        return $this->belongsTo(Note::class);
    }
}
