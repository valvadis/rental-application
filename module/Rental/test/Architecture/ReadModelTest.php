<?php

namespace RentalTest\Architecture;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use PhpAT\Rule\Rule;
use PhpAT\Selector\Selector;
use PhpAT\Test\ArchitectureTest;
use Rental\Application\CommandInterface;

class ReadModelTest extends ArchitectureTest
{
    public function testReadModelDoesNotDependOnWriteModel(): Rule
    {
        return $this->newRule
            ->classesThat(Selector::havePath('src/Query/*'))
            ->mustNotDependOn()
            ->classesThat(Selector::havePath('src/Application/*'))
            ->build();
    }
}
