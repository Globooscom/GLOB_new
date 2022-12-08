<?php

namespace App\Providers;

use SleepingOwl\Admin\Providers\AdminSectionsServiceProvider as ServiceProvider;
use AdminNavigation;

class AdminSectionsServiceProvider extends ServiceProvider
{

  /**
   * @var array
   */
  protected $sections = [
    \App\Models\User::class => 'App\Http\Admin\Users',
    //houses
    \App\Models\Builder\HouseModel::class => 'App\Http\Admin\House\House',
    \App\Models\Builder\Info\TypesModel::class => 'App\Http\Admin\House\Info\Type',
    \App\Models\Builder\Info\StructureModel::class => 'App\Http\Admin\House\Info\Structure',
    \App\Models\Builder\HouseCharacteristicsModel::class => 'App\Http\Admin\House\HouseCharacteristics'
  ];

  /**
   * Register sections.
   *
   * @param \SleepingOwl\Admin\Admin $admin
   * @return void
   */
  public function boot(\SleepingOwl\Admin\Admin $admin)
  {
    $this->app->call([
      $this,
      'registerNavigation'
    ]);

    parent::boot($admin);
  }

  public function registerNavigation()
  {
    AdminNavigation::setFromArray([
      [
        'title' => 'Настройки',
        'id' => 'settings',
        'icon' => 'fab fa-dev',
        'priority' => 100,
      ],
      [
        'title' => 'Жилые комплексы',
        'id' => 'houses',
        'icon' => 'fab fa-dev',
        'priority' => 200,
      ],
    ]);
  }
}