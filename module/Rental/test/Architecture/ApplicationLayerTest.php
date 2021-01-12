<?php

namespace RentalTest\Architecture;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use PhpAT\Rule\Rule;
use PhpAT\Selector\Selector;
use PhpAT\Test\ArchitectureTest;
use Rental\Application\CommandInterface;

class ApplicationLayerTest extends ArchitectureTest
{
    public function testApplicationCanOnlyDependOnDomainLayer(): Rule
    {
        return $this->newRule
            ->classesThat(Selector::havePath('src/Application/*'))
            ->canOnlyDependOn()
            ->classesThat(Selector::havePath('src/Domain/*'))
            ->andClassesThat(Selector::havePath('src/Application/*'))
            ->andClassesThat(Selector::haveClassName(Collection::class))
            ->andClassesThat(Selector::haveClassName(ArrayCollection::class))
            ->build();
    }

    public function testCommandsExtendCommandInterface(): Rule
    {
        return $this->newRule
            ->classesThat(Selector::haveClassName('Rental\Application\Handler\*'))
            ->excludingClassesThat(Selector::haveClassName('Rental\Application\Handler\*Handler'))
            ->mustImplement()
            ->classesThat(Selector::haveClassName(CommandInterface::class))
            ->build();
    }
}
