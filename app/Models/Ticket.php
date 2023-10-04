<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Ticket extends Model
{
    use HasFactory,HasUuid;
    protected $fillable=[
        'title',
        'description',
        'attach',
        'priority',
        'assigned_user_agent',
        'multiple_categories',
        'multiple_labels'
    ];
  public function user():BelongsTo
  {
    return $this->belongsTo(User::class);

  }
  public function categories():BelongsTo
  {
    return $this->belongsTo(Category::class);  }
    public function label():BelongsTo
    {
      return $this->belongsTo(Label::class);
    }
}
