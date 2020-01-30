<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
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
        'news' => 'required',
        'newstitle' => 'required'
      ];

      return $validate_rule;
    }

    public function messages() {
      $msg = [
        'news.required' => '↓内容は必須入力です！',
        'newstitle.required' => '↓タイトルは必須入力です！'
      ];

      return $msg; // 忘れずに!
    }
}
