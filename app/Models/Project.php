<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Project extends Model
{
    use HasFactory;
    protected $fillable=['title', 'slug', 'subtitle', 'description', 'image','url', 'type_id'];

  /**
   * Get the type that owns the Project
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function type(): BelongsTo
  {
      return $this->belongsTo(Type::class);
  }

  /**
   * The Technologies that belong to the Project
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
   */
  public function Technologies(): BelongsToMany
  {
      return $this->belongsToMany(Technology::class);
  }
}
