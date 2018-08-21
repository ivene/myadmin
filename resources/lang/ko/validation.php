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

    'accepted'             => ':attribute 반드시 접수.',
    'active_url'           => ':attribute 유효 사이트가 아닙니다.',
    'after'                => ':attribute 반드시 :date보다 늦어야 합니다.',
    'after_or_equal'       => ':attribute 반드시:date과 일치하거나 늦어야 합니다.',
    'alpha'                => ':attribute 반드시 자모로 구성되여야 합니다.',
    'alpha_dash'           => ':attribute 반드시 자모,수자와 슬래시로 구성되여야 합니다.',
    'alpha_num'            => ':attribute 반드시 자모와 수자로 구성되여야 합니다.',
    'array'                => ':attribute 반드시 배열이여야 합니다.',
    'before'               => ':attribute 반드시 :date보다 빨라야 합니다.',
    'before_or_equal'      => ':attribute 반드시  :date과 일치하거나 빨라야 합니다.',
    'between'              => [
        'numeric' => ':attribute 반드시min - :max 사이에 있어야 합니다.',
        'file'    => ':attribute 반드시 :min - :max kb 사이에 있어야 합니다.',
        'string'  => ':attribute 반드시 :min - :max 개 문자 부호사이에 있어야 합니다.',
        'array'   => ':attribute 반드시 :min - :max 개 단원이여야 합니다..',
    ],
    'boolean'              => ':attribute 반드시 불치여야 합니다.',
    'confirmed'            => ':attribute 두번의 입력이 일치하지 않습니다.',
    'date'                 => ':attribute 유효날짜가 아닙니다.',
    'date_format'          => ':attribute 의 격식은 반드시 :format여야 합니다.',
    'different'            => ':attribute 과 :other 반드시 부동해야 합니다.',
    'digits'               => ':attribute 반드시 :digits 자리 수자여야 합니다.',
    'digits_between'       => ':attribute 반드시 :min 과 :max 자리의 수자여야 합니다.',
    'dimensions'           => ':attribute 이미지 사이즈가 정확하지 않습니다.',
    'distinct'             => ':attribute 이미 존재합니다.',
    'email'                => ':attribute 합법적인 이메일이 아닙니다.',
    'exists'               => ':attribute 존재하지 않습니다.',
    'file'                 => ':attribute 반드시 파일이여야 합니다.',
    'filled'               => ':attribute 비여서는 않됩니다.',
    'image'                => ':attribute 반드시 이미지여야 합니다.',
    'in'                   => '선택한 속성 :attribute 비법.',
    'in_array'             => ':attribute :other 중에 없습니다.',
    'integer'              => ':attribute 반드시 정수여야 합니다.',
    'ip'                   => ':attribute 반드시 유효한 IP주소여야 합니다.',
    'ipv4'                 => ':attribute 반드시 유효한 IPv4 주소여야 합니다.',
    'ipv6'                 => ':attribute 반드시 유효한  IPv6 주소여야 합니다.',
    'json'                 => ':attribute 반드시 정확한 JSON격식이여야 합니다.',
    'max'                  => [
        'numeric' => ':attribute  :max보다 크면 않됩니다.',
        'file'    => ':attribute :max kb보다 크면 않됩니다.',
        'string'  => ':attribute  :max개 문자 부호보다 크면 않됩니다.',
        'array'   => ':attribute 최대 :max 개 단원이 있어야 합니다.',
    ],
    'mimes'                => ':attribute 반드시 :values 유형의 파일이여야 합니다.',
    'mimetypes'            => ':attribute 반드시  :values유형의 파일이여야 합니다.',
    'min'                  => [
        'numeric' => ':attribute 크기는  :min과 일치하거나 커야 합니다.',
        'file'    => ':attribute 크기는  :min kb보다 작아서는 않됩니다.',
        'string'  => ':attribute최소 :min 개 문자 부호가 있어야 합니다.',
        'array'   => ':attribute 최소 :min 개 단원이 있어야 합니다.',
    ],
    'not_in'               => '선택한 속성 :attribute 비법.',
    'numeric'              => ':attribute 반드시 수자여야 합니다.',
    'present'              => ':attribute 반드시 존재하여야 합니다.',
    'regex'                => ':attribute 격식이 정확하지 않습니다.',
    'required'             => ':attribute 비여서는 않됩니다.',
    'required_if'          => ' :other가  :value 일시 :attribute 비여서는 않됩니다.',
    'required_unless'      => ' :other가 :value 이 아닐시 :attribute 비여서는 않됩니다.',
    'required_with'        => ' :values 존재시 :attribute 비여서는 않됩니다.',
    'required_with_all'    => ' :values 존재시 :attribute 비여서는 않됩니다.',
    'required_without'     => ' :values 존재하지 않을시 :attribute 비여서는 않됩니다.',
    'required_without_all' => ' :values 존재하지 않을시 :attribute  비여서는 않됩니다.',
    'same'                 => ':attribute 과 :other 반드시 일치해야 합니다.',
    'size'                 => [
        'numeric' => ':attribute 크기는 반드시 :size여야 합니다.',
        'file'    => ':attribute 크기는 반드시 :size kb여야 합니다.',
        'string'  => ':attribute 반드시 :size개 문자 부호여야 합니다.',
        'array'   => ':attribute 반드시 :size 개 단원이여야 합니다.',
    ],
    'string'               => ':attribute 반드시 문자열이여야 합니다.',
    'timezone'             => ':attribute 반드시 합법적인 시간대여야 합니다.',
    'unique'               => ':attribute 이미 존재합니다.',
    'uploaded'             => ':attribute 업로드 실패.',
    'url'                  => ':attribute 격식이 정확하지 않습니다.',

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
        'op_remark'             => '조작비고',
        'change_token'          => 'CEC수량',
        'email_address'         => '이메일',
        'mobile_phone'          => '핸드폰번호',
        'login_name'            => '아이디',
        'wallet'                => '지갑주소',
        'sms_code'              => '인증번호',
        'clientid'              => '클라이언트번호',
        'cec_name'              => '닉네임',
        'username'              => '아이디',
        'email'                 => '이메일',
        'pwd'                   => '비밀번호',
        'pwd_confirmation'      => '비밀번호 확인',

        'first_name'            => '명',
        'last_name'             => '성',
        'city'                  => '도시',
        'country'               => '국가',
        'address'               => '주소',
        'phone'                 => '전화번호',
        'mobile'                => '핸드폰번호',
        'age'                   => '년령',
        'sex'                   => '성별',
        'gender'                => '성별',
        'day'                   => '일',
        'month'                 => '월',
        'year'                  => '년',
        'hour'                  => '시',
        'minute'                => '분',
        'second'                => '초',
        'title'                 => '타이틀',
        'content'               => '내용',
        'description'           => '묘사',
        'excerpt'               => '개요',
        'date'                  => '날짜',
        'time'                  => '시간',
        'available'             => '사용가능',
        'size'                  => '크기',

    ],

];