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
 */
class Folder extends Entity implements FolderInterface
{
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
     * @return RackInterface|\Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rack()
    {
        // TODO: Implement rack() method.
    }

    /**
     * @return NoteInterface[]|\Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function notes()
    {
        // TODO: Implement notes() method.
    }
}
