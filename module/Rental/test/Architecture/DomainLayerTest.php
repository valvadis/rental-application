<?php

namespace RentalTest\Architecture;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use PhpAT\Rule\Rule;
use PhpAT\Selector\Selector;
use PhpAT\Test\ArchitectureTest;

class DomainLayerTest extends ArchitectureTest
{
    public function testDomainDoesNotDependOnOtherLayers(): Rule
    {
        return $this->newRule
            ->classesThat(Selector::havePath('src/Domain/*'))
            ->canOnlyDependOn()
            ->classesThat(Selector::havePath('src/Domain/*'))
            ->andClassesThat(Selector::haveClassName(Collection::class))
            ->andClassesThat(Selector::haveClassName(ArrayCollection::class))
            ->build();
    }
}
