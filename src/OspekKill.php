<?php
namespace OspekCli;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;
class OspekKill extends Command
{
    protected function configure()
    {
        $this->setName("kill")
            ->setDescription("kill pid")
            ->setHelp("kill process by given pid")
            ->addArgument('pid', InputArgument::OPTIONAL, 'number pid')
            ->addOption('file', 'f', InputOption::VALUE_OPTIONAL, 'path to file contain number pid');
    }
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $_ospek = new \Ospek\OspekBackend();
        $ispid = true;
        if($input->getArgument("pid")) {
            $pid = (int)$input->getArgument("pid");
            $_ospek->setPid($pid);
        } elseif($input->getOption("file") && file_exists($input->getOption("file"))) {
            $pid = (int)file_get_contents($input->getOption("file"));
            $_ospek->setPid($pid);
        } else{
            $ispid = false;
        }
        if($ispid) {
            $_ospek->stop();
            $output->writeln("<comment>Done!</comment>");
        } else{
            $output->writeln("<error>can't find the right pid!</error>");     
        }
    }
    
}