<?php

class Listener
{
    public function onKernelController($event)
    {
        $currentController = $event->getController();
        $newController = function() use ($currentController) {
            // pre-execute
            print_r('hello');exit;
            $rs = call_user_func_array($currentController, func_get_args());
            // post-execute

            return $rs;
        };
        $event->setController($newController);
    }
}