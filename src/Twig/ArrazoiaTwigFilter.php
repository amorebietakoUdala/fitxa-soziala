<?php

namespace App\Twig;

use App\Entity\Arrazoia;
use Doctrine\ORM\PersistentCollection;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class ArrazoiaTwigFilter extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('filterArrazoia', [$this, 'filterArrazoia']),
        ];
    }

    public function filterArrazoia(PersistentCollection $arrazoiak, int $lvl): array
    {
      $arrazoiakFiltered = $arrazoiak->filter(function (Arrazoia $arrazoia) use ($lvl) {
         return $arrazoia->getLvl() === $lvl;
         });
      return $arrazoiakFiltered->toArray();
    }
}