<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Spatie\Permission\Traits\HasRoles;

use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements MustVerifyEmail, JWTSubject
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasRoles,HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'logo',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function doctor(){
            return $this->hasOne(Doctor::class);
    }

    public function events(){
            return $this->hasMany(Event::class);
    }
    public function pagos(){
            return $this->hasMany(Pago::class);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }



        public function adminlte_image()
        {
            // Puedes retornar la ruta de la foto del usuario o un avatar por defecto
            return $this->logo ? asset('storage/' .$this->logo) 
            : 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . 
            '&background=0D8ABC&color=fff' ; 
            // O si usas Gravatar/local: return $this->foto ? asset('storage/'.$this->foto) : 'https://picsum.photos/300/300';
        }
        public function adminlte_desc()
        {
            return $this->roles->pluck('name')->first(); // O return $this->role; si lo tienes dinámico
        }
        

}
