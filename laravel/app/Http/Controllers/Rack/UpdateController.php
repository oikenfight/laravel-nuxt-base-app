<?php
declare(strict_types=1);

namespace App\Http\Controllers\Rack;

use App\Http\Controllers\Controller;
use App\Http\UseCases\Contracts\Rack\UpdateUseCaseInterface;
use Illuminate\Http\Request;

/**
 * Class UpdateController
 * @package App\Http\Controllers\Rack
 */
final class UpdateController extends Controller
{
  public function __invoke(Request $request, UpdateUseCaseInterface $useCase)
  {
      $rack = $useCase((int) $request->route('Rack'), $request);

      return response()->json([
          'rack' => $rack,
      ]);
  }
}
