<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailPasswordReset extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    // クラス生成時にユーザ情報と新規パスワードを確保
    protected $user;
    public function __construct($user, $new_password)
    {
        $this->user = $user;
        $this->new_password = $new_password;

    }

    // メール送信処理
    public function build()
    {
        // メールのタイトル・bladeファイル・変数をセット
        return $this
            ->subject('パスワードがリセットされました')
            ->view('auth.email.password_reset')
            ->with([
                'username' => $this->user->username,
                'new_password' => $this->new_password
            ]);
    }
}
