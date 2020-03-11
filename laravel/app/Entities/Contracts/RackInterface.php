<?php
declare(strict_types=1);

namespace App\Entities\Contracts;

/**
 * RackInterface interface
 *
 * @package App\Entities\Contracts
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entities\Folder[] $folders
 * @property-read int|null $folders_count
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
 */
interface RackInterface extends EntityInterface
{
  /**
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|UserInterface
   */
  public function user();

  /**
   * @return \Illuminate\Database\Eloquent\Relations\hasMany|FolderInterface
   */
  public function folders();
}
