<?php

/*
 * This file is part of the Hautelook\AliceBundle package.
 *
 * (c) Baldur Rensch <brensch@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hautelook\AliceBundle\Tests\SymfonyApp;

use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle;
use Fidry\PsyshBundle\PsyshBundle;
use Hautelook\AliceBundle\HautelookAliceBundle;
use Hautelook\AliceBundle\Tests\SymfonyApp\TestBundle\Bundle\ABundle\TestABundle;
use Hautelook\AliceBundle\Tests\SymfonyApp\TestBundle\Bundle\BBundle\TestBBundle;
use Hautelook\AliceBundle\Tests\SymfonyApp\TestBundle\Bundle\CBundle\TestCBundle;
use Hautelook\AliceBundle\Tests\SymfonyApp\TestBundle\TestBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        return [
            new DoctrineBundle(),
            new DoctrineFixturesBundle(),
            new FrameworkBundle(),
            new HautelookAliceBundle(),
            new TestBundle(),
            new TestABundle(),
            new TestBBundle(),
            new TestCBundle(),
            new PsyshBundle(),
        ];
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        switch ($this->getEnvironment()) {
            case 'alt1':
                $loader->load(__DIR__.'/config/config_alt1.yml');
                break;

            case 'alt2':
                $loader->load(__DIR__.'/config/config_alt2.yml');
                break;

            case 'alt3':
                $loader->load(__DIR__.'/config/config_alt3.yml');
                break;

            default:
                $loader->load(__DIR__.'/config/config.yml');
                break;
        }
    }
}
