<?php

namespace Framework\Middleware;



use Framework\Session;

class Authorize {
    public function isAuthorized()
    {
        return Session::has("user");
    }
    public function handle($role) {
        if($role == "guest" && $this->isAuthorized()) {
            return redirect("/");
        } elseif ($role == "auth" && !$this->isAuthorized()) {
            return redirect("/auth/login");
        }
    }
}