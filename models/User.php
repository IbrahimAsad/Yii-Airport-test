<?php

namespace app\models;

class User extends \yii\base\Object implements \yii\web\IdentityInterface
{
    public $id;
    public $username;
    public $password;
    public $authKey;
    public $accessToken;

    private static $users = [
        '150' => [
            'id' => '150',
            'username' => 'admin',
            'password' => 'admin',
            'authKey' => 'test150key',
            'accessToken' => '150-token',
        ],
        '400' => [
            'id' => '400',
            'username' => 'user',
            'password' => 'user',
            'authKey' => 'test400key',
            'accessToken' => '400-token',
        ],
        '800' => [
            'id' => '800',
            'username' => 'guest',
            'password' => 'guest',
            'authKey' => 'test800key',
            'accessToken' => '800-token',
        ],
    ];

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        foreach (self::$users as $user) {
            if (strcasecmp($user['username'], $username) === 0) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }

    public static function getUserType($id){
        switch ($id) {
            case 150:
                return 'admin';
                break;
            case 400:
                return 'user';
                break;
            case 800:
                return 'guest';
                break;
            
        }
        return 'error';
    }
}
