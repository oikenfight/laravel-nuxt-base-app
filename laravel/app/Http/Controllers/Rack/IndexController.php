<?php
declare(strict_types=1);

namespace App\Http\Controllers\Rack;

use App\Entities\Contracts\RackInterface;
use App\Entities\Contracts\UserInterface;
use App\Http\Controllers\Controller;
use App\Services\ResponseDataMakers\Contracts\ResponseRacksMakerInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

/**
 * Class IndexController
 * @package App\Http\Controllers\Rack
 */
final class IndexController extends Controller
{
    /**
     * @param Request $request
     *
     * @param ResponseRacksMakerInterface $responseMaker
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        /** @var UserInterface $user */
        $user = $request->user();

        /** @var RackInterface[] $racks */
        $racks = $user->racks()->get();

        return response()->json(['racks' => $racks]);
    }
}
