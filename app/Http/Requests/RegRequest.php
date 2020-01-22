<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     *@return array
     */
    public function rules() {
      //検証ルール
      $validate_rule = [
        /*
        'name' => 'required',
        'mail' => 'required | email',
        'pass' => 'required | alpha_num' //alpha_numで英数字かの判定
        */
        'shopname' => 'required',
        'homepage' => 'nullable|url'
      ];

      return $validate_rule;
    }

    public function messages() {
      $msg = [
        /*
        'name.required' => '必須入力です！',
        'mail.required' => '必須入力です！',
        'mail.email' => 'メールアドレスの形で入力してください！',
        'pass.required' => '必須入力です！',
        'pass.alpha_num' => 'パスワードは英数字で設定してください！'
        */
        'shopname.required' => '必須入力です！',
        'homepage.url' => 'URLの形で入力してください！'
      ];

      return $msg; // 忘れずに!
    }
}
