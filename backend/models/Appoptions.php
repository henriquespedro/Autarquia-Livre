<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "config".
 *
 * @property integer $id
 * @property string $server_url
 * @property string $manual_url
 * @property string $proxy
 * @property string $domain
 * @property string $ldap
 * @property integer $ldap_port
 * @property string $smtp_host
 * @property integer $smtp_port
 * @property string $smtp_username
 * @property string $smtp_password
 */
class Appoptions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'config';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ldap_port', 'smtp_port'], 'integer'],
            [['server_url', 'manual_url', 'proxy', 'ldap', 'smtp_host'], 'string', 'max' => 150],
            [['domain'], 'string', 'max' => 50],
            [['smtp_username', 'smtp_password'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'server_url' => 'URL GeoServer',
            'manual_url' => 'Url Manual',
            'proxy' => 'Endereço de Proxy',
            'domain' => 'Domínio',
            'ldap' => 'Ldap',
            'ldap_port' => 'Porta ldap',
            'smtp_host' => 'Servidor smtp',
            'smtp_port' => 'Porta servidor smtp',
            'smtp_username' => 'Email',
            'smtp_password' => 'Password',
        ];
    }
}
