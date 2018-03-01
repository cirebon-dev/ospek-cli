<?php

namespace Ospek;
use \Joli\JoliNotif\Notification;
use \Joli\JoliNotif\NotifierFactory ;
class OspekFrontend extends OspekBackend
{
    private $notif;
    private $fun;
    private $joliNotifier;
    public function __construct(bool $notif)
    {
        $this->pid = getmypid();
        $this->notif = ($notif)?true:false;
        $this->joliNotifier = ($notif)?NotifierFactory:: create():false;
    }
    private function defaultNotif()
    {
        $notification = (new Notification())->setTitle('OSPEK')->setBody("process ".$this->pid." has been stopped!")->setIcon(__DIR__ . '/../asset/icon.png')->addOption('sound', 'Frog');
        $this->joliNotifier->send($notification);
    }
    public function setNotif(callable $fun)
    {
        $this->fun = $fun;
    }
        
    public function __destruct()
    {
        if($this->notif) {
            if($this->fun!=null) {
                ($this->fun)($this->joliNotifier, new Notification());
            } else{
                $this->defaultNotif();
            }
        }
    }
}