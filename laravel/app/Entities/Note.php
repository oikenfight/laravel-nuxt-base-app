<?php

namespace App\Entities;

use App\Entities\Contracts\FolderInterface;
use App\Entities\Contracts\ItemInterface;
use App\Entities\Contracts\NoteInterface;
use App\Entities\Contracts\UserInterface;

/**
 * Class Note
 *
 * @package App\Entities
 */
class Note extends Entity implements NoteInterface
{
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
     * @return FolderInterface|\Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function folder()
    {
        // TODO: Implement folder() method.
    }

    /**
     * @return ItemInterface[]|\Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function items()
    {
        // TODO: Implement items() method.
    }
}
