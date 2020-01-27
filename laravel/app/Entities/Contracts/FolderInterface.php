<?php
declare(strict_types=1);

namespace App\Entities\Contracts;

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
 * @property-read \Illuminate\Database\Eloquent\Relations\BelongsTo|UserInterface $user
 * @property-read \Illuminate\Database\Eloquent\Relations\BelongsTo|RackInterface $rack
 * @property-read \Illuminate\Database\Eloquent\Relations\HasMany|NoteInterface $notes
 */
interface FolderInterface extends EntityInterface
{
  /**
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|UserInterface
   */
  public function user();

  /**
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|RackInterface
   */
  public function rack();

  /**
   * @return \Illuminate\Database\Eloquent\Relations\hasMany|NoteInterface
   */
  public function notes();
}