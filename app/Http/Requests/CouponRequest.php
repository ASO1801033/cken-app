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
        'contents' => 'required',
        'title' => 'required',
        'startdate' => 'required',
        'finishdate' => 'required'
      ];

      return $validate_rule;
    }

    public function messages() {
      $msg = [
        'contents.required' => '↓内容は必須入力です！',
        'title.required' => '↓タイトルは必須入力です！',
        'startdate.required' => '↓開始日時は必須入力です！',
        'finishdate.required' => '↓終了日時は必須入力です！'
      ];

      return $msg; // 忘れずに!
    }
}
