<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Spatie\WelcomeNotification\ReceivesWelcomeNotification;
use App\Notifications\WelcomeNotification;
use Carbon\Carbon;
use Auth;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, ReceivesWelcomeNotification;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'users';
    protected $fillable = [
        'emp_id',
        'email',
        'password',
        'date_created',
        'user_status',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'emp_id', 'emp_id');
    }

    // public function sendWelcomeNotification(Carbon $validUntil)
    // {
    //     // Generate a welcome notification token
    //     $this->welcome_notification_token = Str::random(30);
    //     $this->welcome_valid_until = $validUntil;
    //     $this->save();
    // }

    public function sendWelcomeNotification(Carbon $validUntil)
    {
        $this->notify(new WelcomeNotification($validUntil));
    }
    

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
