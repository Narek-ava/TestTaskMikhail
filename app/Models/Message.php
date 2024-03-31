<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int|mixed $user_id
 * @property string $theme
 * @property string $text
 * @property string $status
 */
class Message extends Model
{
    use HasFactory;
    protected $fillable =['status'];
}
