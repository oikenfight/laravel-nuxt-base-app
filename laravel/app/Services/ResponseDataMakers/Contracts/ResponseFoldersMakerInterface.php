<?php
declare(strict_types=1);

namespace App\Services\ResponseDataMakers\Contracts;

use App\Entities\Contracts\FolderInterface;
use Illuminate\Support\Collection;

/**
 * Interface ResponseFolderMakerInterface
 * @package App\Services\ResponseDataMaker\Contracts
 */
interface ResponseFoldersMakerInterface extends ResponseDataMakerInterface
{
    /**
     * @param Collection|FolderInterface[] $racks
     *
     * @return Collection
     */
    public function make(Collection $racks): Collection;
}
