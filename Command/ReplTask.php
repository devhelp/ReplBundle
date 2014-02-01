<?php

namespace Devhelp\ReplBundle\Command;

use Boris\Boris;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Run boris script task with passing service container
 *
 * @author <michal@devhelp.pl>
 */
class ReplTask extends ContainerAwareCommand
{
    /**
     * @var string
     */
    public $prompt = "symfony debug>";

    /**
     * @return void
     */
    protected function configure()
    {
        $this
            ->setName('devhelp:repl')
            ->setDescription('Run REPL shell command with Boris library');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $app = $this->getApplication();
        $container = $this->getContainer();

        $app->setCatchExceptions(false);

        $boris = new Boris($this->prompt);
        $boris->setLocal(
            array(
                'app' => $app,
                'container' => $container
            )
        );

        $boris->start();
    }

}