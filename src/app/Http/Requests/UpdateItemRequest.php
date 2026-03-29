<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_id' => 'required|exists:categories,id',
            'condition_id' => 'required|exists:conditions,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,gif|max:2048',
            'price' => 'required|integer|min:1',
        ];
    }

    public function messages()
    {
        return [
            'category_id.required' => 'カテゴリーを入力してください',
            'category_id.exists' => '選択されたカテゴリーは存在しません。',
            'condition_id.required' => '状態を入力してください',
            'condition_id.exists' => '選択された状態は存在しません。',
            'name.required' => '商品名は必須です',
            'name.string' => '商品名を文字列で入力してください',
            'name.max' => '商品名を255文字以内で入力してください',
            'description.required' => '商品説明は必須です',
            'description.max' => '説明は1000文字以内で入力してください。',
            'image.image' => '画像ファイルを選択してください',
            'image.mimes' => '画像は、jpeg、png、gifタイプのファイルでなければなりません',
            'image.max' => '画像サイズは、2MB以下にしてください',
            'price.required' => '価格は必須です',
            'price.integer' => '価格は整数で入力してください',
            'price.min' => '価格は1円以上で入力してください',
        ];
    }
}
