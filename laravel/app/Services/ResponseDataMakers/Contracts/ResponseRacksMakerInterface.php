<?php
declare(strict_types=1);

namespace App\Services\ResponseDataMakers\Contracts;

use App\Entities\Contracts\RackInterface;
use Illuminate\Support\Collection;

/**
 * Interface ResponseRackMakerInterface
 * @package App\Services\ResponseDataMaker\Contracts
 */
interface ResponseRacksMakerInterface extends ResponseDataMakerInterface
{
    /**
     * @param Collection|RackInterface[] $racks
     * @return array
     */
    public function make(Collection $racks): Collection;
}
