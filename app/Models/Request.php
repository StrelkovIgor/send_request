<?php

namespace App\Models;

use App\Events\RequestAnswer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Request
 * @package App\Models
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $message
 * @property string $comment
 * @property string $status
 */

class Request extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'message'];

    const STATUS_ACTIVE = 'Active';
    const STATUS_RESOLVED = 'Resolved';

}
