<?php

require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/Tests/SymfonyApp/autoload.php';

use Doctrine\ORM\EntityManagerInterface;
use Hautelook\AliceBundle\Alice\DataFixtures\Loader;

$kernel = new \Hautelook\AliceBundle\Tests\SymfonyApp\AppKernel('bench', false);
$kernel->boot();

$container = $kernel->getContainer();

/* @var Loader $fixturesLoader */
$fixturesLoader = $kernel->getContainer()->get('hautelook_alice.fixtures.loader');
/* @var EntityManagerInterface $entityManager */
$entityManager = $kernel->getContainer()->get('doctrine.orm.entity_manager');

$fixturesLoader->load(
    new \Nelmio\Alice\Persister\Doctrine($entityManager),
    [
        __DIR__.'/tests/SymfonyApp/TestBundle/DataFixtures/ORM/brand.yml',
        __DIR__.'/tests/SymfonyApp/TestBundle/DataFixtures/ORM/product.yml',
    ]
);
