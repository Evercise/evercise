<?php namespace ajax;

use  Input,  Sentry, Event, Response, Exception, Trainer;
use Cartalyst\Sentry\Users\UserNotActivatedException;
use Cartalyst\Sentry\Users\UserNotFoundException;
use Cartalyst\Sentry\Users\WrongPasswordException;
use Cartalyst\Sentry\Throttling\UserSuspendedException;

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

        $result = '';
        try
        {
            $user = Sentry::authenticate($credentials, false);

            if ($user)
            {
                Sentry::loginAndRemember($user);
                if ($redirect_after_login) {
                    return Response::json(
                        [
                            'callback' => 'gotoUrl',
                            'url'      => $redirect_after_login_url
                        ]
                    );
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
        catch(WrongPasswordException $e)
        {
            $result = 'Incorrect email or password';
        }
        catch(UserNotFoundException $e)
        {
            $result =  'Incorrect email or password';
        }
        catch(UserNotActivatedException $e)
        {
            $result = 'Your account has not been activated';
        }
        catch(UserSuspendedException $e)
        {
            $result = 'Your account has been suspended';
        }
        catch(Exception $e)
        {
            $result = $e->getMessage();
        }

        return Response::json([
            'callback' => 'error',
            'validation_failed' => 1,
            'errors' => $result
        ]);
    }
}