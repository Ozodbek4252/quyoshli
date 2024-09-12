<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    */

    'accepted' => ':attribute qabul qilinishi kerak.',
    'active_url' => ':attribute noto‘g‘ri URL.',
    'after' => ':attribute :date dan keyin bo‘lishi kerak.',
    'after_or_equal' => ':attribute :date ga teng yoki keyin bo‘lishi kerak.',
    'alpha' => ':attribute faqat harflarni qabul qiladi.',
    'alpha_dash' => ':attribute faqat harflarni, raqamlarni va chiziqchalarni qabul qiladi.',
    'alpha_num' => ':attribute faqat harflarni va raqamlarni qabul qiladi.',
    'array' => ':attribute to‘plam bo‘lishi kerak.',
    'before' => ':attribute :date dan oldin bo‘lishi kerak.',
    'before_or_equal' => ':attribute :date ga teng yoki oldin bo‘lishi kerak.',

    'between' => [
        'numeric' => ':attribute :min va :max orasida bo‘lishi kerak.',
        'file' => ':attribute :min va :max kilobayt orasida bo‘lishi kerak.',
        'string' => ':attribute :min va :max belgi orasida bo‘lishi kerak.',
        'array' => ':attribute :min va :max elementlar orasida bo‘lishi kerak.',
    ],

    'boolean' => ':attribute maydoni faqat mantiqiy qiymatni qabul qiladi.',
    'confirmed' => ':attribute tasdiqlash mos kelmadi.',
    'date' => ':attribute sana emas.',
    'date_equals' => ':attribute :date ga teng bo‘lishi kerak.',
    'date_format' => ':attribute :format formatga mos kelmaydi.',
    'different' => ':attribute va :other farqli bo‘lishi kerak.',
    'digits' => ':attribute :digits raqamdan iborat bo‘lishi kerak.',
    'digits_between' => ':attribute uzunligi :min va :max orasida bo‘lishi kerak.',
    'dimensions' => ':attribute noto‘g‘ri tasvir o‘lchamlari.',
    'distinct' => ':attribute maydoni takrorlanuvchi qiymatlarga ega.',
    'email' => ':attribute elektron pochta manzili bo‘lishi kerak.',
    'ends_with' => ':attribute quyidagi qiymatlardan biri bilan tugashi kerak: :values',
    'exists' => 'Tanlangan :attribute noto‘g‘ri.',
    'file' => ':attribute fayl bo‘lishi kerak.',
    'filled' => ':attribute maydoni to‘ldirilishi shart.',

    'gt' => [
        'numeric' => ':attribute :value dan katta bo‘lishi kerak.',
        'file' => ':attribute :value kilobaytdan katta bo‘lishi kerak.',
        'string' => ':attribute :value belgidan ko‘p bo‘lishi kerak.',
        'array' => ':attribute :value elementdan ko‘p bo‘lishi kerak.',
    ],

    'gte' => [
        'numeric' => ':attribute :value dan katta yoki teng bo‘lishi kerak.',
        'file' => ':attribute :value kilobaytdan katta yoki teng bo‘lishi kerak.',
        'string' => ':attribute :value belgidan ko‘p yoki teng bo‘lishi kerak.',
        'array' => ':attribute :value elementdan ko‘p yoki teng bo‘lishi kerak.',
    ],

    'image' => ':attribute rasm bo‘lishi kerak.',
    'in' => 'Tanlangan :attribute noto‘g‘ri.',
    'in_array' => ':attribute maydoni :other da mavjud emas.',
    'integer' => ':attribute butun son bo‘lishi kerak.',
    'ip' => ':attribute haqiqiy IP manzil bo‘lishi kerak.',
    'ipv4' => ':attribute haqiqiy IPv4 manzil bo‘lishi kerak.',
    'ipv6' => ':attribute haqiqiy IPv6 manzil bo‘lishi kerak.',
    'json' => ':attribute JSON qatori bo‘lishi kerak.',

    'lt' => [
        'numeric' => ':attribute :value dan kichik bo‘lishi kerak.',
        'file' => ':attribute :value kilobaytdan kichik bo‘lishi kerak.',
        'string' => ':attribute :value belgidan kam bo‘lishi kerak.',
        'array' => ':attribute :value elementdan kam bo‘lishi kerak.',
    ],

    'lte' => [
        'numeric' => ':attribute :value dan kichik yoki teng bo‘lishi kerak.',
        'file' => ':attribute :value kilobaytdan kichik yoki teng bo‘lishi kerak.',
        'string' => ':attribute :value belgidan kam yoki teng bo‘lishi kerak.',
        'array' => ':attribute :value elementdan kam yoki teng bo‘lishi kerak.',
    ],

    'max' => [
        'numeric' => ':attribute :max dan katta bo‘lmasligi kerak.',
        'file' => ':attribute :max kilobaytdan katta bo‘lmasligi kerak.',
        'string' => ':attribute :max belgidan ko‘p bo‘lmasligi kerak.',
        'array' => ':attribute :max elementdan ko‘p bo‘lmasligi kerak.',
    ],

    'mimes' => ':attribute quyidagi turlardan biri bo‘lishi kerak: :values.',
    'mimetypes' => ':attribute quyidagi turlardan biri bo‘lishi kerak: :values.',

    'min' => [
        'numeric' => ':attribute kamida :min bo‘lishi kerak.',
        'file' => ':attribute kamida :min kilobayt bo‘lishi kerak.',
        'string' => ':attribute kamida :min belgi bo‘lishi kerak.',
        'array' => ':attribute kamida :min element bo‘lishi kerak.',
    ],

    'not_in' => 'Tanlangan :attribute noto‘g‘ri.',
    'not_regex' => ':attribute formati noto‘g‘ri.',
    'numeric' => ':attribute raqam bo‘lishi kerak.',
    'present' => ':attribute maydoni ko‘rsatilishi kerak.',
    'regex' => ':attribute formati noto‘g‘ri.',
    'required' => ':attribute maydoni to‘ldirilishi shart.',
    'required_if' => ':attribute maydoni :other :value ga teng bo‘lsa, to‘ldirilishi shart.',
    'required_unless' => ':attribute maydoni :other :values ga teng bo‘lmasa, to‘ldirilishi shart.',
    'required_with' => ':values ko‘rsatilgan bo‘lsa, :attribute maydoni to‘ldirilishi shart.',
    'required_with_all' => ':values ko‘rsatilgan bo‘lsa, :attribute maydoni to‘ldirilishi shart.',
    'required_without' => ':values ko‘rsatilmagan bo‘lsa, :attribute maydoni to‘ldirilishi shart.',
    'required_without_all' => ':values laridan hech biri ko‘rsatilmagan bo‘lsa, :attribute maydoni to‘ldirilishi shart.',
    'same' => ':attribute va :other mos kelishi kerak.',

    'size' => [
        'numeric' => ':attribute :size bo‘lishi kerak.',
        'file' => ':attribute :size kilobayt bo‘lishi kerak.',
        'string' => ':attribute :size belgi bo‘lishi kerak.',
        'array' =>  ':attribute :size elementga ega bo‘lishi kerak.',
    ],

    'starts_with' => ':attribute quyidagi qiymatlardan biri bilan boshlanishi kerak: :values',
    'string' => ':attribute qator bo‘lishi kerak.',
    'timezone' => ':attribute haqiqiy mintaqaviy zonada bo‘lishi kerak.',
    'unique' => ':attribute allaqachon band qilingan.',
    'uploaded' => ':attribute yuklash muvaffaqiyatsiz tugadi.',
    'url' => ':attribute formati noto‘g‘ri.',
    'uuid' => ':attribute haqiqiy UUID bo‘lishi kerak.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    */

    'attributes' => [],

];
