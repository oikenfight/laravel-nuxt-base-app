<?php
declare(strict_types=1);

namespace App\Services\ResponseDataMakers;

use App\Entities\Contracts\FolderInterface;
use App\Services\ResponseDataMakers\Contracts\ResponseFoldersMakerInterface;
use Illuminate\Support\Collection;

/**
 * Class ResponseFoldersMaker
 * @package App\Services\ResponseDataMakers
 */
final class ResponseFoldersMaker extends ResponseDataMaker implements ResponseFoldersMakerInterface
{
    /**
     * @param Collection|FolderInterface[] $folders
     *
     * @return Collection
     */
    public function make(Collection $folders): Collection
    {
        foreach ($folders as $key => $folder) {
            $folder->folderIds = $folder->folders()->get()->pluck('id');
        }
        return $folders;
    }
}
