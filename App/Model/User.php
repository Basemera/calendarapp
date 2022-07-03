<?php namespace App\Model;
use Illuminate\Database\Eloquent\Model as Eloquent;
class User extends Eloquent
{
   /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
   protected $fillable = [
       'email', 'password'
   ];
   /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
   protected $hidden = [
       'password'
   ];
   /*
   * Get Todo of User
   *
   */
   public function invite()
   {
       return $this->hasMany('Invite', 'invitee_id');
   }

    /*
   * Get Todo of User
   *
   */
  public function send()
  {
      return $this->hasMany('Invite', 'sender_id');
  }

   static function hashPassword($password) {
        return password_hash($password, PASSWORD_DEFAULT);
}

public function login($data) {
    $q = 'select * from users where email = ?';
    
    if (is_array($data)) {
        $params = array(
            $data['email']=> PDO::PARAM_STR,
        );
        $password = $data['password'];
    } else {
        $params = array(
            $data->email=> PDO::PARAM_STR,
        );
        $password = $data->password;
    }
    
    $user = $this->select($q, $params);
    // print_r($user);
    if ($user) {
        $verifyPassword = password_verify($password, $user->password);
        if ($verifyPassword == TRUE) {
            return array('user_id'=>$user->id, 'email'=>$user->email);
        }
    }
    return FALSE;
}
 }