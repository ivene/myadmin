<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | such as the size rules. Feel free to tweak each of these messages.
    |
    */

    'accepted'             => ':attribute 必ずお受取ください。',
    'active_url'           => ':attribute 有効なサイトではありません。',
    'after'                => ':attribute 必ず dateより遅れてください。',
    'after_or_equal'       => ':attribute 必ず:date と等しく、或いはさらに遅くなってください。',
    'alpha'                => ':attribute 僅かに文字からなってください。',
    'alpha_dash'           => ':attribute アルファベット、数字とスラッシュからなっています。',
    'alpha_num'            => ':attribute 僅かにアルファベットと数字からなってください。',
    'array'                => ':attribute 一つの配列になってください。',
    'before'               => ':attribute 必ずdateより早くさせてください。',
    'before_or_equal'      => ':attribute :必ずdate に等しく、或いはさらに早くさせてください。',
    'between'              => [
        'numeric' => ':attribute 必ずmin - :max の間になってください。',
        'file'    => ':attribute 必ずmin - :max kbの間になってください。',
        'string'  => ':attribute 必ずmin - :max つの文字になってください。',
        'array'   => ':attribute 僅かにmin - :max つのユニットがあります。',
    ],
    'boolean'              => ':attribute 必ずブールになってください。',
    'confirmed'            => ':attribute 二回の入力が違います。',
    'date'                 => ':attribute 有効的日付ではありません',
    'date_format'          => ':attribute フォームが必ずformatになってください。',
    'different'            => ':attribute と :other が違います。',
    'digits'               => ':attribute が必ずdigits 桁の数字になってください。',
    'digits_between'       => ':attribute が必ずmin と :max 桁の数字に介入してください。',
    'dimensions'           => ':attribute 写真のサイズが違います。',
    'distinct'             => ':attribute がありました。',
    'email'                => ':attribute が合法的なメールアドレスではありません。',
    'exists'               => ':attribute がありません。',
    'file'                 => ':attribute 必ずファイルになってください。',
    'filled'               => ':attribute 空になってはいけません。',
    'image'                => ':attribute必ず写真になってください。',
    'in'                   => '選ばれた属性 :attribute 非法。',
    'in_array'             => ':attribute が:other にありません。',
    'integer'              => ':attribute が必ず整数になってください。',
    'ip'                   => ':attributeが必ず有効的 IP サイトになってください。',
    'ipv4'                 => ':attribute が必ず有効なIPv4  サイトになってください。',
    'ipv6'                 => ':attribute が必ず有効な IPv6 サイトになってください。',
    'json'                 => ':attribute が必ず精確な JSON フォームになってください。',
    'max'                  => [
        'numeric' => ':attributeがmaxより大きくならないでください。',
        'file'    => ':attribute がmax kbより大きくならないでください。',
        'string'  => ':attribute がmax つの文字より大きくならないでください。',
        'array'   => ':attribute が多くてもmax つのユニットがあります。',
    ],
    'mimes'                => ':attribute が必ずvalues タイプのファイルになってください。',
    'mimetypes'         => ':attribute が必ずvalues  タイプのファイルになってください。。',
    'min'                  => [
        'numeric' => ':attribute がminより大きく、或いは等しくなってください。',
        'file'    => ':attribute がmin kbより小さくならないでください。',
        'string'  => ':attribute が少なくとも:min つの文字になってください。',
        'array'   => ':attribute が少なくともmin つのユニットがあります。',
    ],
    'not_in'               => '選ばれた属性 :attribute非法。',
    'numeric'              => ':attribute が必ず数字になってください。',
    'present'              => ':attribute が必ず存在します。',
    'regex'                => ':attribute フォームが精確的ではありません。',
    'required'             => ':attribute が空になれません。',
    'required_if'          => ' :other がvalue になる場合 :attributeが空になれません。',
    'required_unless'      => ' :other がvalue にならない場合:attribute が空になれません。',
    'required_with'        => ' :values が存在する場合 :attribute が空になれません。',
    'required_with_all'    => 'values が存在する場合 ::attribute が空になれません。',
    'required_without'     => 'values が存在しない場合：attribute が空になれません。',
    'required_without_all' => 'values が存在しない場合：attribute が空になれません。',
    'same'                 => ':attribute と:other が必ず同じになってください。',
    'size'                 => [
        'numeric' => ':attribute サイズが必ず sizeになってください。',
        'file'    => ':attribute サイズが必ずsize kbになってください。',
        'string'  => ':attribute が必ずize つの文字になってください。',
        'array'   => ':attribute が必ず:size つのユニットになってください。',
    ],
    'string'               => ':attribute が必ず文字列になってください。',
    'timezone'             => ':attribute が必ず合法的なタイムゾーン値になってください。',
    'unique'               => ':attribute がありました。',
    'uploaded'             => ':attribute アップロード失敗。',
    'url'                  => ':attribute フォームが不正確です。',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention 'attribute.rule' to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom'               => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of 'email'. This simply helps us make messages a little cleaner.
    |
    */

    'attributes'           => [
        'op_remark'             => '操作備考',
        'change_token'          => 'CEC数量',
        'email_address'         => 'メールアドレス',
        'mobile_phone'          => '電話番号',
        'login_name'            => 'ユーザーネーム',
        'wallet'                => 'ウォレットサイト',
        'sms_code'              => 'メッセージ検証コード',
        'clientid'              => 'クライアント端末番号',
        'cec_name'              => 'ニックネーム',
        'username'              => 'ユーザーネーム',
        'email'                 => 'メールアドレス',
        'pwd'                   => 'パスワード',
        'pwd_confirmation'      => 'パスワードチェック',

        'first_name'            => '名前',
        'last_name'             => '氏名',
        'city'                  => '都市',
        'country'               => '国',
        'address'               => '所在地',
        'phone'                 => '電話番号',
        'mobile'                => 'スマートフォン',
        'age'                   => '年齢',
        'sex'                   => '性别',
        'gender'                => '性别',
        'day'                   => '日',
        'month'                 => '月',
        'year'                  => '年',
        'hour'                  => '事',
        'minute'                => '分間',
        'second'                => '秒',
        'title'                 => 'タイトル',
        'content'               => '内容',
        'description'           => '描写',
        'excerpt'               => '要旨',
        'date'                  => '日付',
        'time'                  => '時間',
        'available'             => '利用できます',
        'size'                  => 'サイズ',

    ],

];