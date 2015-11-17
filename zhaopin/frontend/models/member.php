<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "member".
 *
 * @property integer $member_id
 * @property string $email
 * @property string $password
 * @property integer $member_type
 * @property string $member_photo
 * @property string $member_name
 * @property string $member_phone
 * @property string $qq_openid
 * @property string $weibo_openid
 * @property string $verify
 */
class member extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'member';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['member_type'], 'integer'],
            [['email', 'verify'], 'string', 'max' => 50],
            [['password'], 'string', 'max' => 32],
            [['member_photo'], 'string', 'max' => 255],
            [['member_name'], 'string', 'max' => 30],
            [['member_phone'], 'string', 'max' => 20],
            [['qq_openid', 'weibo_openid'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'member_id' => 'Member ID',
            'email' => 'Email',
            'password' => 'Password',
            'member_type' => 'Member Type',
            'member_photo' => 'Member Photo',
            'member_name' => 'Member Name',
            'member_phone' => 'Member Phone',
            'qq_openid' => 'Qq Openid',
            'weibo_openid' => 'Weibo Openid',
            'verify' => 'Verify',
        ];
    }
}
