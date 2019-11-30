<?php


namespace App\Libraries;

use Phalcon\Acl;
use Phalcon\Acl\Adapter\Memory as AclList;
use Phalcon\Acl\Resource;
use Phalcon\Acl\Role;
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

        foreach ($role as $item){
            $acl->addRole(new Role($item));
        }

        foreach ($resources as $resource => $action) {
            $acl->addResource(new Resource($resource), $action);
        }

        foreach ($allowed as $role => $resources){
            foreach ($resources as $resource => $action){
//                $acl->allow($role, $resource, $action);
                foreach($action as $single){
                    $acl->allow($role, $resource, $single);
                }
            }
        }
//        $test = 1;
//        foreach ($roles as $roleName => $role){
//            $acl->addRole(new Role($roleName));
//            foreach($role as $resource => $actions){
//                $acl->addResource(
//                    new Resource($resource),
//                    $actions
//                );
//                $acl->allow($roleName, $resource, '*');
//            }
//        }
//        $this->acl = $acl;
        return $acl;
    }

    public function beforeExecuteRoute(Event $event, Dispatcher $dispatcher){
        $auth = $this->di->get('auth');
        if($auth->id() == 1){
            $role = 'Pemilik';
        }
        else if($auth->checkAuth()){
            $role = 'Karyawan';
        }
        else{
            $role = 'Guests';
        }
        // Take the active controller/action from the dispatcher
        $controller = $dispatcher->getControllerName();
        $action     = $dispatcher->getActionName();

        if($controller == 'auth' and $role != 'Guests'){
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