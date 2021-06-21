<?php

namespace App\Models;

use Exception;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $table = 'users';

    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sUser',
        'sPassword',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'sPassword'
    ];

    public function registerAccess(Array $inputs)
    {
        try {
            DB::beginTransaction();
            $user = User::create([
                'sUser' => $inputs['sUser'],
                'sPassword' => bcrypt($inputs['sPassword'])
            ]);
            $token = $user->createToken($inputs['sUser'])->plainTextToken;
            DB::commit();
            return $token;
        } catch (Exception $erro) {
            DB::rollback();
            throw new Exception($erro->getMessage(), 1);
        }
    }
}
