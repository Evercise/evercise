<?php namespace ajax;

use  Input,  Sentry, Event, Response, Exception, Trainer;

class AuthController extends AjaxBaseController
{
    /**
     * Login action
     * @return Redirect
     */
    public function postLogin()
    {
        $credentials = array(
            'email' => Input::get('email'),
            'password' => Input::get('password')
        );


        $redirect_after_login = Input::get('redirect_after_login');
        $redirect_after_login_url = Input::get('redirect_after_login_url');
        //return(var_dump($redirect_after_login_url));
        try
        {
            $user = Sentry::authenticate($credentials, false);

            if ($user)
            {
                Sentry::loginAndRemember($user);
                if ($redirect_after_login == 1) {
                    return Response::json(route($redirect_after_login_url));
                }
                else
                {
                    return Response::json(
                        [
                            'callback' => 'gotoUrl',
                            'url'      => route('users.edit', $user->display_name)
                        ]
                    );
                }


            }
        }
        catch(Exception $e)
        {
            $result = array(
                'callback' => 'error',
                'validation_failed' => 1,
                'errors' => $e->getMessage()
            );
            return Response::json($result);
        }
    }
}