<?php
namespace Application\Sonata\UserBundle\Form\Handler;
use Sonata\UserBundle\Model\UserInterface;
use Sonata\UserBundle\Form\Handler\ProfileFormHandler as BaseHandler;

class ProfileFormHandler extends BaseHandler 
{

    public function process(UserInterface $user)
    {

        $this->form->setData($user);
        if ('POST' == $this->request->getMethod()) {
            $this->form->bindRequest($this->request);

            if ($this->form->isValid()) {
                $this->onSuccess($user);
                return true;
            }
            $this->userManager->reloadUser($user);
        }
        return false;
    }

    protected function onSuccess(UserInterface $user)
    {
        $this->userManager->updateUser($user);
    }
}