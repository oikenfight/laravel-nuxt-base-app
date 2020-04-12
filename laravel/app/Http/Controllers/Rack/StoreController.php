<?php
declare(strict_types=1);

namespace App\Http\Controllers\Rack;

use App\Entities\Contracts\RackInterface;
use App\Entities\Contracts\UserInterface;
use App\Http\Controllers\Controller;
use App\Http\UseCases\Contracts\Rack\StoreUseCaseInterface;
use Illuminate\Http\Request;

final class StoreController extends Controller
{
    /**
     * @param Request $request
     * @param StoreUseCaseInterface $useCase
     * @return \Illuminate\Http\JsonResponse
     */
  public function __invoke(Request $request, StoreUseCaseInterface $useCase)
  {
      /** @var UserInterface $user */
      $user = $request->user();

      /** @var RackInterface $rack */
      $rack = $useCase($user);

      return response()->json([
          'rack' => $rack
      ]);
  }
}
