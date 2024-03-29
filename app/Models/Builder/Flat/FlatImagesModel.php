<?php

namespace App\Models\Builder\Flat;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlatImagesModel extends Model
{
  use HasFactory;

  protected $fillable = [
    'flat_id',
    'name',
    'category',
    'isResize'
  ];

  protected $hidden = [
    'created_at',
    'updated_at',
  ];

  /**
   * belong method for flat
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */

  public function flat()
  {
    return $this->belongsTo(FlatModel::class, 'flat_id', 'id');
  } //end
}
