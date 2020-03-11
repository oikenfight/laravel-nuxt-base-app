<?php
declare(strict_types=1);

namespace App\Entities\Contracts;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * FolderInterface interface
 *
 * @package App\Entities\Contracts
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
 */
interface FolderInterface extends EntityInterface
{
  /**
   * @return BelongsTo|UserInterface
   */
  public function user();

  /**
   * @return BelongsTo|RackInterface
   */
  public function rack();

  /**
   * @return hasMany|NoteInterface[]
   */
  public function notes();
}
