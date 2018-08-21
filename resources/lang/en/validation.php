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

    'accepted'             => ':attribute accepted。',
    'active_url'           => ':attribute not a valid URL。',
    'after'                => ':attribute must after : data。',
    'after_or_equal'       => ':attribute must after : data or even later。',
    'alpha'                => ':attribute can only be made up of letters。',
    'alpha_dash'           => ':attribute can only be made up of letters, numbers, and slashes。',
    'alpha_num'            => ':attribute can only be made up of letters and numbers.。',
    'array'                => ':attribute must be an array。',
    'before'               => ':attribute must before : data。',
    'before_or_equal'      => ':attribute must before : data or even earlier。',
    'between'              => [
        'numeric' => ':attribute must between :min - :max。',
        'file'    => ':attribute must between :min - :max kb。',
        'string'  => ':attribute must between :min - :max character。',
        'array'   => ':attribute must obly have :min - :max units。',
    ],
    'boolean'              => ':attribute must be the boolean value。',
    'confirmed'            => ':attribute two times input inconsistency。',
    'date'                 => ':attribute not a valid date。',
    'date_format'          => 'the format of attribute must be :format。',
    'different'            => ':attribute  must be different from other。',
    'digits'               => ':attribute must be the :digits。',
    'digits_between'       => ':attribute must be the digits between :min and :max。',
    'dimensions'           => ':attribute picture dimension is not correct。',
    'distinct'             => ':attribute already exist。',
    'email'                => ':attribute not a legitimate mailbox.。',
    'exists'               => ':attribute does not exist。',
    'file'                 => ':attribute must be a file。',
    'filled'               => ':attribute cannot be empty。',
    'image'                => ':attribute must be an image。',
    'in'                   => 'selected attributes: illegal attribute。',
    'in_array'             => ': attribute is not in the other。',
    'integer'              => ':attribute must be an integer。',
    'ip'                   => ':attribute must be a valid IP address。',
    'ipv4'                 => ':attribute must be a valid IPV4 address。',
    'ipv6'                 => ':attribute must be a valid IPV6 address。',
    'json'                 => ':attribute must be in the correct JSON format。',
    'max'                  => [
        'numeric' => ':attribute cannot greater than :max。',
        'file'    => ':attribute cannot greater than :max kb。',
        'string'  => ':attribute cannot greater than :max charters。',
        'array'   => ': max units is the most attribute.。',
    ],
    'mimes'                => ':attribute must be a file of values type。',
    'mimetypes'            => ':attribute must be a file of values type。',
    'min'                  => [
        'numeric' => ':attribute must be greater than or equal to :min。',
        'file'    => ':attribute size cannot be less than :min kb。',
        'string'  => ':attribute at least: min character。',
        'array'   => ':attribute at least: min units。',
    ],
    'not_in'               => 'selected attributes: illegal attribute。',
    'numeric'              => ': attribute must be a number。',
    'present'              => ': attribute must exist。',
    'regex'                => ': attribute format is not correct。',
    'required'             => ':attribute cannot be empty。',
    'required_if'          => 'when other is value, attribute cannot be empty。',
    'required_unless'      => 'when other is not value, attribute cannot be empty。',
    'required_with'        => 'when values exist, attribute cannot be empty。',
    'required_with_all'    => 'when values exist, attribute cannot be empty。',
    'required_without'     => 'when values do not exist, attribute cannot be empty。',
    'required_without_all' => ' when values all do not exist, attribute cannot be empty。',
    'same'                 => ':attribute  and other must be the same 。',
    'size'                 => [
        'numeric' => ':the size of attribute must be :size。',
        'file'    => ': the size of attribute must be :size kb。',
        'string'  => ':attribute must be :size character。',
        'array'   => ': attribute must be :size units。',
    ],
    'string'               => ':attribute must be a character string。',
    'timezone'             => ':attribute must be a valid time zone value。',
    'unique'               => ':attribute already exist。',
    'uploaded'             => ':attribute upload failed。',
    'url'                  => ':attribute form is not correct。',

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
        'op_remark'             => 'operation remark',
        'change_token'          => 'CEC number',
        'email_address'         => 'email address',
        'mobile_phone'          => 'mobile phone',
        'login_name'            => 'login name',
        'wallet'                => 'wallet address',
        'sms_code'              => 'sms verification code',
        'clientid'              => 'client end No.',
        'cec_name'              => 'CEC name',
        'username'              => 'user name',
        'email'                 => 'email',
        'pwd'                   => 'password',
        'pwd_confirmation'      => 'password confirmation',

        'first_name'            => 'first name',
        'last_name'             => 'last name',
        'city'                  => 'city',
        'country'               => 'country',
        'address'               => 'address',
        'phone'                 => 'phone',
        'mobile'                => 'mobile phone',
        'age'                   => 'age',
        'sex'                   => 'sex',
        'gender'                => 'gender',
        'day'                   => 'day',
        'month'                 => 'month',
        'year'                  => 'year',
        'hour'                  => 'hour',
        'minute'                => 'minute',
        'second'                => 'second',
        'title'                 => 'title',
        'content'               => 'content',
        'description'           => 'description',
        'excerpt'               => 'excerpt',
        'date'                  => 'date',
        'time'                  => 'time',
        'available'             => 'available',
        'size'                  => 'size',

    ],

];