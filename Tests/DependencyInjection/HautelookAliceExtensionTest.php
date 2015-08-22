<?php

/*
 * This file is part of the Hautelook\AliceBundle package.
 *
 * (c) Baldur Rensch <brensch@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hautelook\AliceBundle\Tests\DependencyInjection;

use Hautelook\AliceBundle\DependencyInjection\HautelookAliceExtension;
use Prophecy\Argument;

/**
 * @coversDefaultClass Hautelook\AliceBundle\DependencyInjection\HautelookAliceExtension
 *
 * @author Théo FIDRY <theo.fidry@gmail.com>
 */
class HautelookAliceExtensionTest extends \PHPUnit_Framework_TestCase
{
    private static $defaultConfig = [
        'hautelook_alice' => [
            'locale'        => 'en_US',
            'seed'          => 1,
            'fixtures_path' => 'DataFixtures/ORM',
        ],
    ];

    /**
     * @cover ::__construct
     */
    public function testConstruct()
    {
        $extension = new HautelookAliceExtension();
        $this->assertInstanceOf('Symfony\Component\DependencyInjection\Extension\ExtensionInterface', $extension);
        $this->assertInstanceOf(
            'Symfony\Component\DependencyInjection\Extension\ConfigurationExtensionInterface',
            $extension
        );
    }

    public function testLoadDefaultConfig()
    {
        $extension = new HautelookAliceExtension();

        $containerBuilderProphecy = $this->getContainerBuilderProphecy();
        $containerBuilderProphecy->setParameter('hautelook_alice.locale', 'en_US')->shouldBeCalled();
        $containerBuilderProphecy->setParameter('hautelook_alice.seed', 1)->shouldBeCalled();
        $containerBuilderProphecy->setParameter('hautelook_alice.fixtures_path', 'DataFixtures/ORM')->shouldBeCalled();

        $extension->load(self::$defaultConfig, $containerBuilderProphecy->reveal());
    }

    public function testLoadCustomConfig()
    {
        $extension = new HautelookAliceExtension();

        $containerBuilderProphecy = $this->getContainerBuilderProphecy();
        $containerBuilderProphecy->setParameter('hautelook_alice.locale', 'fr_FR')->shouldBeCalled();
        $containerBuilderProphecy->setParameter('hautelook_alice.seed', 100)->shouldBeCalled();
        $containerBuilderProphecy
            ->setParameter('hautelook_alice.fixtures_path', 'Resources/fixtures/ORM')
            ->shouldBeCalled()
        ;

        $extension->load(
            [
                'hautelook_alice' => [
                    'locale'        => 'fr_FR',
                    'seed'          => 100,
                    'fixtures_path' => 'Resources/fixtures/ORM',
                ]
            ],
            $containerBuilderProphecy->reveal()
        );
    }

    private function getContainerBuilderProphecy()
    {
        $containerBuilderProphecy = $this->prophesize('Symfony\Component\DependencyInjection\ContainerBuilder');
        $containerBuilderProphecy->hasExtension('http://symfony.com/schema/dic/services')->shouldBeCalled();

        $definitionArgument = Argument::type('Symfony\Component\DependencyInjection\Definition');
        $containerBuilderProphecy
            ->addResource(Argument::type('Symfony\Component\Config\Resource\ResourceInterface'))
            ->shouldBeCalled()
        ;

        $containerBuilderProphecy
            ->setDefinition('hautelook_alice.faker', $definitionArgument)
            ->shouldBeCalled()
        ;
        $containerBuilderProphecy
            ->setDefinition('hautelook_alice.alice.processor_chain', $definitionArgument)
            ->shouldBeCalled()
        ;
        $containerBuilderProphecy
            ->setDefinition('hautelook_alice.faker.provider_chain', $definitionArgument)
            ->shouldBeCalled()
        ;
        $containerBuilderProphecy
            ->setDefinition('hautelook_alice.fixtures.loader', $definitionArgument)
            ->shouldBeCalled()
        ;
        $containerBuilderProphecy
            ->setDefinition('hautelook_alice.doctrine.finder', $definitionArgument)
            ->shouldBeCalled()
        ;
        $containerBuilderProphecy
            ->setDefinition('hautelook_alice.doctrine.command.load_command', $definitionArgument)
            ->shouldBeCalled()
        ;

        return $containerBuilderProphecy;
    }
}
