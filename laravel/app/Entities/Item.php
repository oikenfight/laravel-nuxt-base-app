<?php

namespace App\Entities;

use App\Entities\Contracts\ItemInterface;
use App\Entities\Contracts\NoteInterface;
use App\Entities\Contracts\UserInterface;

/**
 * Class Item
 *
 * @package App\Entities
 */
class Item extends Entity implements ItemInterface
{
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
    'deleted_at',
  ];

    /**
     * @return UserInterface|\Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        // TODO: Implement user() method.
    }

    /**
     * @return NoteInterface|\Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function note()
    {
        // TODO: Implement note() method.
    }
}
