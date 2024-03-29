<?php

namespace App\Models\Log;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageLogModel extends Model
{
    use HasFactory;

    protected $fillable = [
      'title',
      'image',
      'error',
    ];
}
