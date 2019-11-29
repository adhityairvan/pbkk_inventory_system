<?php


namespace App\Libraries;

use Phalcon\Acl;
use Phalcon\Acl\Adapter\Memory as AclList;
use Phalcon\Acl\Role;
use Phalcon\Acl\Resource;
use Phalcon\DiInterface;
use Phalcon\Dispatcher;
use Phalcon\Events\Event;

class Guard
{
    private $acl = null;
    private $di;
    public function __construct(DiInterface $di)
    {
        $this->di = $di;
    }

    private function getAcl(){
        if(!is_null($this->acl)){
            return $this->acl;
        }
        $acl = new AclList();

        $acl->setDefaultAction(Acl::DENY);

        require APP_PATH.'/config/acl.php';

        $test = 1;
        foreach ($roles as $roleName => $role){
            $acl->addRole(new Role($roleName));
            foreach($role as $resource => $actions){
                $acl->addResource(
                    new Resource($resource),
                    $actions
                );
                $acl->allow($roleName, $resource, '*');
            }
        }
        $this->acl = $acl;
        return $acl;
    }

    public function beforeExecuteRoute(Event $event, Dispatcher $dispatcher){
        $auth = $this->di->get('auth')->checkAuth();
        if($auth){
            $role = 'LoggedIn';
        }
        else{
            $role = 'Guests';
        }
        // Take the active controller/action from the dispatcher
        $controller = $dispatcher->getControllerName();
        $action     = $dispatcher->getActionName();

        if($controller == 'auth' and $role == 'LoggedIn'){
            $dispatcher->forward([
                'controller' => 'item',
                'action' => 'index'
            ]);
            return false;
        }

        $acl = $this->getAcl();

        $allowed = $acl->isAllowed($role, $controller, $action);
        if(!$allowed){
            $dispatcher->forward([
                'controller' => 'auth',
                'action' => 'showLogin'
            ]);

            return false;
        }
    }
}