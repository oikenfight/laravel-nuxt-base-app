<?php
declare(strict_types=1);

namespace App\Http\Controllers\Rack;

use App\Http\Controllers\Controller;
use App\Http\UseCases\Contracts\Rack\DeleteUseCaseInterface;
use Illuminate\Http\Request;

/**
 * Class DestroyController
 * @package App\Http\Controllers\Rack
 */
final class DestroyController extends Controller
{
  public function __invoke(Request $request, DeleteUseCaseInterface $useCase)
  {
      $useCase((int) $request->route('Rack'));

      return response()->json([
          'result' => 'success',
      ]);
  }
}
