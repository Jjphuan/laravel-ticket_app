<?php

return [

    'accepted' => ':attribute 必须接受。',
    'accepted_if' => '当 :other 为 :value 时，:attribute 必须接受。',
    'active_url' => ':attribute 不是一个有效的网址。',
    'after' => ':attribute 必须是 :date 之后的日期。',
    'after_or_equal' => ':attribute 必须是 :date 之后或相同的日期。',
    'alpha' => ':attribute 只能包含字母。',
    'alpha_dash' => ':attribute 只能包含字母、数字、破折号和下划线。',
    'alpha_num' => ':attribute 只能包含字母和数字。',
    'array' => ':attribute 必须是一个数组。',
    'ascii' => ':attribute 只能包含单字节的字母数字字符和符号。',
    'before' => ':attribute 必须是 :date 之前的日期。',
    'before_or_equal' => ':attribute 必须是 :date 之前或相同的日期。',
    'between' => [
        'array' => ':attribute 的项数必须在 :min 到 :max 之间。',
        'file' => ':attribute 必须在 :min 到 :max KB 之间。',
        'numeric' => ':attribute 必须在 :min 到 :max 之间。',
        'string' => ':attribute 必须在 :min 到 :max 个字符之间。',
    ],
    'boolean' => ':attribute 必须为 true 或 false。',
    'can' => ':attribute 包含未经授权的值。',
    'confirmed' => ':attribute 确认不匹配。',
    'current_password' => '密码不正确。',
    'date' => ':attribute 不是一个有效的日期。',
    'date_equals' => ':attribute 必须是等于 :date 的日期。',
    'date_format' => ':attribute 必须符合格式 :format。',
    'decimal' => ':attribute 必须有 :decimal 位小数。',
    'declined' => ':attribute 必须被拒绝。',
    'declined_if' => '当 :other 为 :value 时，:attribute 必须被拒绝。',
    'different' => ':attribute 和 :other 必须不同。',
    'digits' => ':attribute 必须是 :digits 位数字。',
    'digits_between' => ':attribute 必须在 :min 到 :max 位数字之间。',
    'dimensions' => ':attribute 图片尺寸无效。',
    'distinct' => ':attribute 包含重复的值。',
    'doesnt_end_with' => ':attribute 不能以以下之一结尾: :values。',
    'doesnt_start_with' => ':attribute 不能以以下之一开头: :values。',
    'email' => ':attribute 必须是有效的邮箱地址。',
    'ends_with' => ':attribute 必须以以下之一结尾: :values。',
    'enum' => '所选的 :attribute 无效。',
    'exists' => '所选的 :attribute 无效。',
    'extensions' => ':attribute 的扩展名必须是以下之一: :values。',
    'file' => ':attribute 必须是一个文件。',
    'filled' => ':attribute 不能为空。',
    'gt' => [
        'array' => ':attribute 必须多于 :value 项。',
        'file' => ':attribute 必须大于 :value KB。',
        'numeric' => ':attribute 必须大于 :value。',
        'string' => ':attribute 必须多于 :value 个字符。',
    ],
    'gte' => [
        'array' => ':attribute 必须包含 :value 项或更多。',
        'file' => ':attribute 必须大于或等于 :value KB。',
        'numeric' => ':attribute 必须大于或等于 :value。',
        'string' => ':attribute 必须大于或等于 :value 个字符。',
    ],
    'hex_color' => ':attribute 必须是有效的十六进制颜色值。',
    'image' => ':attribute 必须是一张图片。',
    'in' => '所选的 :attribute 无效。',
    'in_array' => ':attribute 必须存在于 :other 中。',
    'integer' => ':attribute 必须是整数。',
    'ip' => ':attribute 必须是有效的 IP 地址。',
    'ipv4' => ':attribute 必须是有效的 IPv4 地址。',
    'ipv6' => ':attribute 必须是有效的 IPv6 地址。',
    'json' => ':attribute 必须是有效的 JSON 字符串。',
    'lowercase' => ':attribute 必须是小写。',
    'lt' => [
        'array' => ':attribute 必须少于 :value 项。',
        'file' => ':attribute 必须小于 :value KB。',
        'numeric' => ':attribute 必须小于 :value。',
        'string' => ':attribute 必须少于 :value 个字符。',
    ],
    'lte' => [
        'array' => ':attribute 不能多于 :value 项。',
        'file' => ':attribute 必须小于或等于 :value KB。',
        'numeric' => ':attribute 必须小于或等于 :value。',
        'string' => ':attribute 必须小于或等于 :value 个字符。',
    ],
    'mac_address' => ':attribute 必须是有效的 MAC 地址。',
    'max' => [
        'array' => ':attribute 不能多于 :max 项。',
        'file' => ':attribute 不能大于 :max KB。',
        'numeric' => ':attribute 不能大于 :max。',
        'string' => ':attribute 不能多于 :max 个字符。',
    ],
    'max_digits' => ':attribute 不能多于 :max 位数字。',
    'mimes' => ':attribute 文件类型必须是: :values。',
    'mimetypes' => ':attribute 文件类型必须是: :values。',
    'min' => [
        'array' => ':attribute 至少有 :min 项。',
        'file' => ':attribute 至少为 :min KB。',
        'numeric' => ':attribute 至少为 :min。',
        'string' => ':attribute 至少为 :min 个字符。',
    ],
    'min_digits' => ':attribute 至少有 :min 位数字。',
    'missing' => ':attribute 必须缺失。',
    'missing_if' => '当 :other 为 :value 时，:attribute 必须缺失。',
    'missing_unless' => '除非 :other 为 :value，:attribute 必须缺失。',
    'missing_with' => '当存在 :values 时，:attribute 必须缺失。',
    'missing_with_all' => '当 :values 存在时，:attribute 必须缺失。',
    'multiple_of' => ':attribute 必须是 :value 的倍数。',
    'not_in' => '所选的 :attribute 无效。',
    'not_regex' => ':attribute 格式无效。',
    'numeric' => ':attribute 必须是数字。',
    'password' => [
        'min' => '密码长度至少为 :min 个字符。',
        'letters' => ':attribute 必须包含至少一个字母。',
        'mixed' => ':attribute 必须包含大小写字母各一个。',
        'numbers' => ':attribute 必须包含至少一个数字。',
        'symbols' => ':attribute 必须包含至少一个符号。',
        'uncompromised' => '所提供的 :attribute 出现在数据泄露中，请使用其他 :attribute。',
    ],
    'present' => ':attribute 必须存在。',
    'present_if' => '当 :other 为 :value 时，:attribute 必须存在。',
    'present_unless' => '除非 :other 为 :value，:attribute 必须存在。',
    'present_with' => '当 :values 存在时，:attribute 必须存在。',
    'present_with_all' => '当 :values 都存在时，:attribute 必须存在。',
    'prohibited' => ':attribute 是禁止的。',
    'prohibited_if' => '当 :other 为 :value 时，:attribute 是禁止的。',
    'prohibited_unless' => '除非 :other 在 :values 中，否则 :attribute 是禁止的。',
    'prohibits' => ':attribute 禁止 :other 出现。',
    'regex' => ':attribute 格式无效。',
    'required' => ':attribute 是必填项。',
    'required_array_keys' => ':attribute 必须包含以下条目: :values。',
    'required_if' => '当 :other 为 :value 时，:attribute 是必填项。',
    'required_if_accepted' => '当 :other 被接受时，:attribute 是必填项。',
    'required_unless' => '除非 :other 在 :values 中，否则 :attribute 是必填项。',
    'required_with' => '当 :values 存在时，:attribute 是必填项。',
    'required_with_all' => '当 :values 都存在时，:attribute 是必填项。',
    'required_without' => '当 :values 不存在时，:attribute 是必填项。',
    'required_without_all' => '当 :values 都不存在时，:attribute 是必填项。',
    'same' => ':attribute 和 :other 必须一致。',
    'size' => [
        'array' => ':attribute 必须包含 :size 项。',
        'file' => ':attribute 必须为 :size KB。',
        'numeric' => ':attribute 必须为 :size。',
        'string' => ':attribute 必须为 :size 个字符。',
    ],
    'starts_with' => ':attribute 必须以以下之一开头: :values。',
    'string' => ':attribute 必须是字符串。',
    'timezone' => ':attribute 必须是有效的时区。',
    'unique' => ':attribute 已被占用。',
    'uploaded' => ':attribute 上传失败。',
    'uppercase' => ':attribute 必须是大写。',
    'url' => ':attribute 必须是有效的网址。',
    'ulid' => ':attribute 必须是有效的 ULID。',
    'uuid' => ':attribute 必须是有效的 UUID。',

    'custom' => [
        'attribute-name' => [
            'rule-name' => '自定义提示信息',
        ],
    ],

    'attributes' => [
        'name'=> '名字',
        'email'=> '邮箱',
        'password'=> '密码',
        'phone_num' => '手机号码'
    ],

];
