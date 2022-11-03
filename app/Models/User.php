<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\cart;
use App\Models\User;
use DB;
use Illuminate\Support\Facades\Hash;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'username'
    ];

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
        'email_verified_at' => 'datetime'
    ];

    /**
     * Get the user associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function cart()
    {
        return $this->hasOne(Cart::class, 'cart_id', 'id');
    }

    public static function loginApi($request)
    {
        $result = [];
        $data = User::
               where('email', '=', $request->email)
                ->first();
        if($data)
        {
            if(!Hash::check($request->password, $data->password))
            {
                $result['status'] = 'error';
                $result['message'] = 'Password yang anda masukkan salah!';
                $result['code'] = 400;
                $result['data'] = null;
            }else{
                $result['status'] = 'success';
                $result['message'] = 'Anda berhasil login!';
                $result['code'] = 200;
                $result['data'] = $data;
            }
        }else{
            $result['status'] = 'error';
            $result['message'] = 'Email tidak dapat ditemukan!';
            $result['code'] = 400;
            $result['data'] = null;
        }

        return $result;
    }

    public static function registerApi($request) {
        $result = [];
        $cekFirstone = User::where('email',$request->email)->first();
        if($cekFirstone) {
            $result['status'] = 'error';
            $result['message'] = 'Email telah digunakan!';
            $result['code'] = 400;
            $result['data'] = null;
        } else {  
            $createUser = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->username,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                // 'roles' => 'user'
            ]);
            
            $logged_in = User::find($createUser->id);
            
            $result['status'] = 'success';
                $result['message'] = 'Anda berhasil register!';
                $result['code'] = 200;
                $result['data'] = $logged_in;
            // Auth::login($logged_in);
            // return redirect('validation/process');
        // }
    }

    return $result;
    }

    public static function EditProfile($request, $id) {
        $result = [];

        
        $cekFirstone = User::where('email',$request->email)->first();
        if($cekFirstone != null && $cekFirstone->id != $id) {
            $result['status'] = 'error';
                $result['message'] = 'Email telah digunakan!';
                $result['code'] = 400;
                $result['data'] = null;
        } else {
            $findUser = User::where('id', $id)->first();
            if($findUser) {
                $findUser->email = $request->email;
                $findUser->name = $request->name;
                $findUser->username = $request->username;
                $findUser->phone = $request->phone;
                // $findUser->password =  bcrypt($request->password);
                $findUser->save();
                
                $result['status'] = 'success';
                    $result['message'] = 'Data berhasil diperbarui!';
                    $result['code'] = 200;
                    $result['data'] = $findUser;
            } else {
                $result['status'] = 'error';
                $result['message'] = 'Data Gagal diperbarui!';
                $result['code'] = 400;
                $result['data'] = null;
            }
        }
        return $result;
    }


}
