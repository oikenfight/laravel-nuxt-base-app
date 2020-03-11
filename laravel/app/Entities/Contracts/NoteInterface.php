<?php
declare(strict_types=1);

namespace App\Entities\Contracts;

use Illuminate\Support\Collection;

/**
 * NoteInterface interface
 *
 * @package App\Entities\Contracts
 * @property int $id
 * @property int $user_id
 * @property int $folder_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Entities\Folder $folder
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entities\Item[] $items
 * @property-read int|null $items_count
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
 */
interface NoteInterface extends EntityInterface
{
  /**
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|UserInterface
   */
  public function user();

  /**
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|FolderInterface
   */
  public function folder();

  /**
   * @return \Illuminate\Database\Eloquent\Relations\hasMany|Collection|ItemInterface[]
   */
  public function items();
}
