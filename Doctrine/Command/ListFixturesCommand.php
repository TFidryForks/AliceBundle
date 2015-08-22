<?php

/*
 * This file is part of the Hautelook\AliceBundle package.
 *
 * (c) Baldur Rensch <brensch@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hautelook\AliceBundle\Doctrine\Command;

use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\Common\Persistence\ManagerRegistry;
use Hautelook\AliceBundle\Alice\DataFixtures\LoaderInterface;
use Hautelook\AliceBundle\Doctrine\DataFixtures\Executor\ORMExecutor;
use Hautelook\AliceBundle\Doctrine\Finder\Finder;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\DialogHelper;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;

/**
 * Command used to list the fixtures.
 *
 * @author Théo FIDRY <theo.fidry@gmail.com>
 */
class ListFixturesCommand extends Command
{
    /**
     * @var Finder
     */
    private $finder;

    /**
     * @param Finder $finder
     */
    public function __construct(Finder $finder)
    {
        parent::__construct();

        $this->finder = $finder;
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('hautelook_alice:fixtures:list')
            ->setDescription('List registered fixtures.')
            ->addOption(
                'bundle',
                'b',
                InputOption::VALUE_OPTIONAL|InputOption::VALUE_IS_ARRAY,
                'Bundles where fixtures should be looked in'
            )
        ;
        //TODO: set help
    }

    /**
     * {@inheritdoc}
     *
     * \RuntimeException Unsupported Application type
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var Application $application */
        $application = $this->getApplication();
        if (false === $application instanceof Application) {
            throw new \RuntimeException('Expected Symfony\Bundle\FrameworkBundle\Console\Application application.');
        }

        // Get bundles
        $bundles = $input->getOption('bundle');
        if (true === empty($bundles)) {
            $bundles = $application->getKernel()->getBundles();
        } else {
            $bundles = $this->finder->resolveBundles($application, $bundles);
        }

        // Get fixtures
        $fixtures = $this->finder->getFixtures($application->getKernel(), $bundles, ucfirst($input->getOption('env')));
        $output->writeln(sprintf('  <comment>></comment> <info>%s</info>', 'fixtures found:'));
        foreach ($fixtures as $fixture) {
            $output->writeln(sprintf('      <comment>-</comment> <info>%s</info>', $fixture));
        }
    }
}
