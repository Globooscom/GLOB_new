<?php


namespace App\Services\Cache;


use App\Services\Houses\HousesService;
use Illuminate\Support\Facades\Cache;
use phpDocumentor\Reflection\Types\Collection;

class CacheService implements CacheInterface
{

  /**
   * update cache for houses
   * @param HousesService $housesService
   */

  public function updateCacheHouses(HousesService $housesService)
  {

    Cache::forget('houses_full');

    $houses = $housesService->getHouses('Новостройка', true, true, 200);

    Cache::put('houses_full', $houses, 21600);

    return $houses;
  }

  /**
   * update cache for villages
   * @param HousesService $housesService
   */

  public function updateCacheVillages(HousesService $housesService)
  {
    Cache::forget('houses_villages_full');

    $houses = $housesService->getHouses('Вилла', false, true, null);

    Cache::put('houses_villages_full', $houses, 21600);

    return $houses;

  } //end
}
