<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true; //trueにする
    }

    /**
     * Get the validation rules that apply to the request.
     *
     *@return array
     */
    public function rules() {
      //検証ルール
      $validate_rule = [
        'homepage' => 'nullable|url',
        'finishdate' => 'after_or_equal:startdate', //クーポン情報修正時に日付バリデーションを適用させる(改良中)
      ];

      return $validate_rule;
    }

    public function messages() {
      $msg = [
        'homepage.url' => 'URLの形で入力してください！',
        'finishdate.after_or_equal:startdate' => '利用終了日の入力に問題があります！' //クーポン情報修正時に日付バリデーションを適用させる(改良中)
      ];

      return $msg; // 忘れずに!
    }
}
