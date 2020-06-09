<?php

namespace App\Http\Controllers\Auth;

//use Illuminate\Http\Request; //追加
//use Illuminate\Support\Facades\Auth; //追加
//use Illuminate\Validation\ValidationException; //追加
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use App\User;
use Mail; // メール送信
use App\Mail\EmailPasswordReset; // パスワードリセット・メール送信

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = '/home';
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    

    // パスワードリセット申し込み画面。メアドを入力する
    public function showPasswordResetForm()
    {
        // ID・パスワードが確認済み(SectionAuthMiddleware)
        $section = Section::where('section_auth_id', session('section_auth_id'))->First();
        return view('auth.passwords.email', compact('section'));
    }

    // 認証に問題がなければ、乱数でパスワード上書き。ログインIDと一緒にメール送信する
    public function sendPasswordResetEmail(Request $request)
    {
        $data = $request->all();    // form入力値

        $user = User::where('section_id', $section->id)
            ->where('email', $data['email'])
            //->where('secret_question', $data['secret_question'])
            //->where('secret_answer', $data['secret_answer'])
            ->first();

        // 本人確認が取れなかったら
        if (!$user) {
            \Session::flash('error_status', '登録した内容では、パスワードの再発行は出来ません');
            return back()->withInput();

            // 本人確認が取れたら
        } else {
            // 乱数パスワードで上書き
            $new_password = self::generate_password();
            $user->password = bcrypt($new_password);
            $user->save();

            // ログインIDとパスワードが入ったメールを送信
            $email = new EmailPasswordReset($user, $new_password);
            Mail::to($user->email)->send($email);

            return view('auth.passwords.thanks');

        }
    }

    // 大文字１文字以上・小文字１文字以上・数字１文字以上の８文字固定の乱数生成
    public function generate_password($password_length = 8)
    {
        $char_seed = [
            'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
            'abcdefghijklmnopqrstuvwxyz',
            '0123456789'
        ];
        $password_string = "";

        //シードの種類だけループ
        for($i=0; $i<count($char_seed); $i++){
            // 各シードから１文字だけ抽出するindexを生成
            $index = mt_rand(0, mb_strlen($char_seed[$i]) - 1);
            // 各シードから１文字だけ抽出
            $password_string .= mb_substr($char_seed[$i], $index, 1);
        }
        // 残りの文字は乱数
        $password_string .= str_random($password_length - count($char_seed));
        // 順不同に、かき混ぜる
        return str_shuffle($password_string);
    }
}

