<?php
namespace Ospek;
class OspekBackend
{
    protected $pid;
    private $pid_file;
    private $command;
    private $log_file;

    public function __construct(String $cl=null, String $log=null) 
    {
        if ($cl != null) {
            $this->command = $cl;
            if($log != null) {
                $this->log_file = $log;
            } else {
                $this->log_file = defined('PHP_WINDOWS_VERSION_BUILD')?"NUL":"/dev/null";
            }
            $this->run();
        }
    }
    private function run() 
    {
        if (defined('PHP_WINDOWS_VERSION_BUILD')) {
            $command = $this->command.' > '.$this->log_file;
            exec("start /B ".$this->command);
        } else{
                 
            $command = $this->command.' > '.$this->log_file.' 2>&1 & echo $!';
            exec($command, $op);
            $this->pid = (int)$op[0];
        }
    }

    public function setPid(int $pid) 
    {
        $this->pid = $pid;
    }

    public function getPid():int 
    {
        return $this->pid;
    }

    public function status():bool 
    {
                // Windows magic, call tasklist.exe and scan for the pid in there.
        if (defined('PHP_WINDOWS_VERSION_BUILD')) {
            $process = shell_exec(sprintf('tasklist.exe /FI "PID eq %d" /FO CSV /NH', $this->pid));

            return in_array($this->pid, str_getcsv($process, ','));
        }

        // We send special signal 0 to test for existance of the process which is much more bullet proof than
        // using anything like shell_exec() wrapped ps/pgrep magic (which is not available on all systems).
        return (bool) posix_kill($this->pid, 0);
    }

    public function start() 
    {
        if ($this->command !=null) {
            $this->run();
        }
        throw new \LengthException("command is empty!");
    }

    public function stop() 
    {
        if (defined('PHP_WINDOWS_VERSION_BUILD')) {
            shell_exec(sprintf('taskkill.exe /PID %d', $this->pid));
        } else{

            posix_kill($this->pid, SIGTERM);
        }
    }
    public function getOutput(String $file):String 
    {
        if(file_exists($file)) {
            return file($file);
        }
        throw new \RunTimeException("file not found!");
    }
}