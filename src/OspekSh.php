<?php
namespace OspekCli;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;
class OspekSh extends Command
{
    protected function configure()
    {
        $this->setName("sh")
            ->setDescription("start sh")
            ->setHelp("run any program/command in background")
            ->addArgument('command', InputArgument::REQUIRED, 'command to be executed')
            ->addOption('pid', 'p', InputOption::VALUE_OPTIONAL, 'path file to store pid')
            ->addOption('output', 'o', InputOption::VALUE_OPTIONAL, 'path file to store output process');
    }
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $command = $input->getArgument("command");
        $out = $input->getOption("output");
        if($out) {
            $_ospek = new \Ospek\OspekBackend($command, $out);
        } else{
            $_ospek = new \Ospek\OspekBackend($command);
        }
        $pid = $input->getOption("pid");
        if($pid) {
            file_put_contents($pid, $_ospek->getPid(), LOCK_EX);
        }
            
    
        $output->writeln('<info>starting "'.$command.'" in background!</info>');
    }
    
}