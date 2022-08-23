<?php

namespace App\Models;

use App\Events\RequestAnswer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request as RequestHttp;

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

    public function hasResolved(): bool
    {
        return $this->status === self::STATUS_RESOLVED && $this->comment;
    }

    public function answer(string $comment): void
    {
        $this->status = self::STATUS_RESOLVED;
        $this->comment = $comment;
        $this->save();

        event(new RequestAnswer($this));
    }

    public static function filters(Builder $builder, RequestHttp $request)
    {
        if ($request->status) {
            $builder->where('status', $request->status);
        }

        if ($request->getDateFrom()) {
            $builder->where('created_at', '>', $request->getDateFrom());
        }

        if ($request->getDateTo()) {
            $builder->where('created_at', '<', $request->getDateTo());
        }

    }

}
