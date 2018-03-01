<?php
namespace OspekCli;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;
class OspekStart extends Command
{
    protected function configure()
    {
        $this->setName("start")
            ->setDescription("start php")
            ->setHelp("run php in background")
            ->addArgument('file', InputArgument::REQUIRED, 'file contain php syntax')
            ->addOption('pid', 'p', InputOption::VALUE_OPTIONAL, 'path file to store pid')
            ->addOption('output', 'o', InputOption::VALUE_OPTIONAL, 'path file to store output process');
    }
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $file = $input->getArgument("file");
        if(file_exists($file)) {
            $out = $input->getOption("output");
            if($out) {
                $_ospek = new \Ospek\OspekBackend("php ".$file, $out);
            } else{
                $_ospek = new \Ospek\OspekBackend("php ".$file);
            }
            $pid = $input->getOption("pid");
            if($pid) {
                file_put_contents($pid, $_ospek->getPid(), LOCK_EX);
            }
            
    
            $output->writeln('<info>starting '.$file.' in background!</info>');
        } else{
            $output->writeln('<error>file '.$file.' not found!</error>');
        }
    }
    
}