<?php
declare(strict_types=1);

namespace App\Entities\Contracts;

/**
 * NoteInterface interface
 * 
 * @package App\Entities\Contracts
 * @property int $id
 * @property int $user_id
 * @property int $folder_id
 * @property string $name
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Relations\BelongsTo|UserInterface $user
 * @property-read \Illuminate\Database\Eloquent\Relations\BelongsTo|FolderInterface $folder
 * @property-read \Illuminate\Database\Eloquent\Relations\hasMany|ItemInterface $items
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
   * @return \Illuminate\Database\Eloquent\Relations\hasMany|ItemInterface
   */
  public function items();
}