<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
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
        'coupontitle' => 'required',
        'startdate' => 'required',
        'starttime' => 'required',
        'finishdate' => 'required',
        'finishtime' => 'required',
      ];

      return $validate_rule;
    }

    public function messages() {
      $msg = [
        'contents.required' => '↓内容は必須入力です！',
        'coupontitle.required' => '↓タイトルは必須入力です！',
        'startdate.required' => '↓必須入力です！',
        'starttime.required' => '↓必須入力です！',
        'finishdate.required' => '↓必須入力です！',
        'finishtime.required' => '↓必須入力です！',
      ];

      return $msg; // 忘れずに!
    }
}
