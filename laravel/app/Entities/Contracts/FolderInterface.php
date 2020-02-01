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
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property-read BelongsTo|UserInterface $user
 * @property-read BelongsTo|RackInterface $rack
 * @property-read HasMany|NoteInterface[] $notes
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
