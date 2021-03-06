<?php

/*
 * This file is part of the Hautelook\AliceBundle package.
 *
 * (c) Baldur Rensch <brensch@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hautelook\AliceBundle\Tests\Doctrine\Command;

use Symfony\Component\Console\Tester\CommandTester;

/**
 * Test suite to ensure HautelookAliceBundle commands are still properly working.
 *
 * @author Théo FIDRY <theo.fidry@gmail.com>
 */
class DoctrineDataFixturesCommandsTest extends CommandTestCase
{
    protected function setUp()
    {
        parent::setUp();

        $this->application->add(
            self::$kernel->getContainer()->get('hautelook_alice.doctrine.command.load_command')
        );
    }

    /**
     * @covers \Hautelook\AliceBundle\Doctrine\DataFixtures\AbstractLoader
     */
    public function testDoctrineORM()
    {
        $command = $this->application->find('doctrine:fixtures:load');

        $commandTester = new CommandTester($command);
        $commandTester->execute([], ['interactive' => false]);

        $expected = <<<EOF
              > purging database
  > loading Hautelook\AliceBundle\Tests\SymfonyApp\TestBundle\DataFixtures\ORM\DataLoader
  > loading Hautelook\AliceBundle\Tests\SymfonyApp\TestBundle\DataFixtures\ORM\Ignored\DataLoader
  > loading Hautelook\AliceBundle\Tests\SymfonyApp\TestBundle\DataFixtures\ORM\Ignored2\DataLoader
  > loading Hautelook\AliceBundle\Tests\SymfonyApp\TestBundle\DataFixtures\ORM\Provider\DataLoader
  > loading Hautelook\AliceBundle\Tests\SymfonyApp\TestBundle\Bundle\CBundle\DataFixtures\ORM\DataLoader
  > loading Hautelook\AliceBundle\Tests\SymfonyApp\TestBundle\Bundle\CBundle\DataFixtures\ORM\AEnv\DataLoader
  > loading Hautelook\AliceBundle\Tests\SymfonyApp\TestBundle\Bundle\CBundle\DataFixtures\ORM\BEnv\DataLoader
  > loading Hautelook\AliceBundle\Tests\SymfonyApp\TestBundle\Bundle\CBundle\DataFixtures\ORM\DEnv\DataLoader
  > loading Hautelook\AliceBundle\Tests\SymfonyApp\TestBundle\Bundle\CBundle\DataFixtures\ORM\EEnv\DataLoader

EOF;

        $this->assertFixturesDisplayEquals($expected, $commandTester->getDisplay());
    }

    public function testDoctrineODM()
    {
        $command = $this->application->find('doctrine:mongodb:fixtures:load');

        $commandTester = new CommandTester($command);
        $commandTester->execute([], ['interactive' => false]);

        $expected = <<<EOF
              > purging database
  > loading Hautelook\AliceBundle\Tests\SymfonyApp\TestBundle\Bundle\DBundle\DataFixtures\MongoDB\DataLoader

EOF;

        $this->assertEquals(trim($expected,' '), trim($commandTester->getDisplay(), ' '));
    }

    public function testDoctrinePHPCR()
    {
        $command = $this->application->find('doctrine:mongodb:fixtures:load');

        $commandTester = new CommandTester($command);
        $commandTester->execute([], ['interactive' => false]);

        $expected = <<<EOF
              > purging database
  > loading Hautelook\AliceBundle\Tests\SymfonyApp\TestBundle\Bundle\DBundle\DataFixtures\MongoDB\DataLoader

EOF;

        $this->assertEquals(trim($expected,' '), trim($commandTester->getDisplay(), ' '));
    }
}
