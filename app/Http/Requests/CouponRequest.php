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
        /*'startyear' => 'required',
        'startmonth' => 'required',
        'startday' => 'required',
        'starthour' => 'required',
        'startminutes' => 'required',
        'finishyear' => 'required',
        'finishmonth' => 'required',
        'finishday' => 'required',
        'finishhour' => 'required',
        'finishminutes' => 'required'*/
      ];

      return $validate_rule;
    }

    public function messages() {
      $msg = [
        'contents.required' => '↓内容は必須入力です！',
        'coupontitle.required' => '↓タイトルは必須入力です！',
        /*'startyear.required' => '↓開始年は必須入力です！',
        'startmonth.required' => '↓開始月は必須入力です！',
        'startday.required' => '↓開始日は必須入力です！',
        'starthour.required' => '↓開始時は必須入力です！',
        'startminutes.required' => '↓開始分は必須入力です！',
        'finishyear.required' => '↓終了年は必須入力です！',
        'finishmonth.required' => '↓終了月は必須入力です！',
        'finishday.required' => '↓終了日は必須入力です！',
        'finishhour.required' => '↓終了時は必須入力です！',
        'finishminutes.required' => '↓終了分は必須入力です！',*/
      ];

      return $msg; // 忘れずに!
    }
}
