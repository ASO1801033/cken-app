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
        'contents.required' => 'クーポン内容は必須入力です！',
        'coupontitle.required' => 'タイトルは必須入力です！',
        'startdate.required' => '利用開始日は必須入力です！',
        'starttime.required' => '利用開始時間は必須入力です！',
        'finishdate.required' => '利用終了日は必須入力です！',
        'finishtime.required' => '利用終了時間は必須入力です！',
      ];

      return $msg; // 忘れずに!
    }
}
