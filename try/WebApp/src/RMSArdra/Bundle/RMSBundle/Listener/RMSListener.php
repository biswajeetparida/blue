<?php
namespace RMSArdra\Bundle\RMSBundle\Listener;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\DependencyInjection\ContainerInterface;

class RMSListener
{
    protected $container;

    public function __construct(ContainerInterface $container) // this is @service_container
    {
        $this->container = $container;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        $kernel    = $event->getKernel();
        $request   = $event->getRequest();
        $container = $this->container;
    }

    public function onKernelResponse(FilterResponseEvent $event)
    {
        $response  = $event->getResponse();
        $request   = $event->getRequest();
        $kernel    = $event->getKernel();
        $container = $this->container;
       
       

    }
    //public function onKernelController($event)
    //{
    //    $currentController = $event->getController();
    //    $newController = function() use ($currentController) {
    //        // pre-execute
    //        
    //        $rs = call_user_func_array($currentController, func_get_args());
    //        // post-execute
    //
    //        return $rs;
    //    };
    //    $event->setController($newController);
    //}
}