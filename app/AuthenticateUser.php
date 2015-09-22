<?php namespace App;

use Auth;
use App\Repositories\UserRepository;
use Laravel\Socialite\Contracts\Factory as Socialite;
use Illuminate\Support\Facades\Session;
class AuthenticateUser {
    /**
     * @var UserRepository
     */
    private $users;
    /**
     * @var Socialite
     */
    private $socialite;
    /**
     * @var Guard
     */
    private $auth;
    /**
     * @param UserRepository $users
     * @param Socialite $socialite
     * @param Guard $auth
     */
    public function __construct(UserRepository $users, Socialite $socialite)
    {
        $this->users = $users;
        $this->socialite = $socialite;
        $this->auth = Auth::user();
    }
    /**
     * @param boolean $hasCode
     * @param AuthenticateUserListener $listener
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function facebook($hasCode, AuthenticateUserListener $listener)
    {

        if ( ! $hasCode) return $this->socialite->driver('facebook')->redirect();

        $user = $this->users->findByUsernameOrCreate($this->socialite->driver('facebook')->user());
    
        $this->auth->login($user, true);
        $userfullname = $this->auth->get()->firstname.' '.$this->auth->get()->lastname;
        Session::put('userfullname', $userfullname);
        return $listener->userHasLoggedIn($user);
    }

    /**
     * @param boolean $hasCode
     * @param AuthenticateUserListener $listener
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function twitter($hasCode, AuthenticateUserListener $listener)
    {
        if ( ! $hasCode) return $this->socialite->driver('twitter')->redirect();

       
        $user = $this->users->findByUsernameOrCreate($this->socialite->driver('twitter')->user());
   
        $this->auth->login($user, true);


        return $listener->userHasLoggedIn($user);
    }

    /**
     * @param boolean $hasCode
     * @param AuthenticateUserListener $listener
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function google($hasCode, AuthenticateUserListener $listener)
    {
        if ( ! $hasCode) return $this->socialite->driver('google')->redirect();

        $user = $this->users->findByUsernameOrCreate($this->socialite->driver('google')->user());
        
        $this->auth->login($user, true);
        return $listener->userHasLoggedIn($user);
    }

}