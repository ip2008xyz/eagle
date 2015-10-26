<?php

namespace Eagle\Auth\Models;

use Phalcon\Flash\Session;
use Phalcon\Mvc\User\Component;

class Auth extends Component {

    /**
     * TODO - better security
     */
    public function isAuth()
    {

        if($this->getId() > 0) {
            return true;
        }
        return false;

    }

    public function logoutUser()
    {
        $this->session->destroy(true);
        $this->session->regenerateId(true);
    }

    public function authUser($credentials)
    {



        // Check if the user exist
        $user = Users::findFirst(array(
            '(user_name = {user_name})',
            'bind' => array(
                'user_name' => $credentials['user_name'],
            ),
        ));

        if ($user === false) {
            return 'User not found';
        }

        if ($user->user_active != Users::ACTIVE) {
            return 'User is not active';
        }


        if (!$this->security->checkHash($credentials['user_password'], $user->user_password)) {
            return ('Invalid password');
        }

        $this->saveUser($user);

        return true;
    }

    protected function saveUser($user) {

        $this->session->regenerateId(true);
        $this->session->set('user_id', $user->user_id);
        $this->session->set('user_name', $user->user_name);

        $permissions = $user->getAllPermissions();
        $permission_data = array();

        foreach($permissions as $permission) {
            $permission_data[$permission['permission_mca']] = $permission['permission_name'];
        }
        $this->session->set('permissions', $permission_data);

    }

    public function getPermissions() {
        return $this->session->get('permissions');
    }
    public function getId()
    {
        return (int) $this->session->get('user_id');
    }


    public function getName()
    {
        return  $this->session->get('user_name');
    }

    public function getLoginUrl() {
        return $this->config->auth->login_url;
    }
    public function getAfterLoginUrl() {
        return $this->config->auth->after_login_url;
    }

}
