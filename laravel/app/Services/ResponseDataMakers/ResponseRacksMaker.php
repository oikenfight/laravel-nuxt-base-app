<?php
declare(strict_types=1);

namespace App\Services\ResponseDataMakers;

use App\Entities\Contracts\RackInterface;
use App\Services\ResponseDataMakers\Contracts\ResponseRacksMakerInterface;
use Illuminate\Support\Collection;

/**
 * Class ResponseRacksMaker
 * @package App\Services\ResponseDataMakers
 */
final class ResponseRacksMaker extends ResponseDataMaker implements ResponseRacksMakerInterface
{
    /**
     * @param Collection|RackInterface[[] $racks
     * @return array
     */
    public function make(Collection $racks): Collection
    {
        foreach ($racks as $key => $rack) {
            $rack->folderIds = $rack->folders->pluck('id');
        }
        return $racks;
    }
}
