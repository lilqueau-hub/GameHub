<?php

namespace App\Factory;

use App\Entity\Jeu;
use Zenstruck\Foundry\Persistence\PersistentObjectFactory;

/**
 * @extends PersistentObjectFactory<Jeu>
 */
final class JeuFactory extends PersistentObjectFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
    }

    #[\Override]
    public static function class(): string
    {
        return Jeu::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    #[\Override]
    protected function defaults(): array|callable
    {
        return [
            'age_minimum' => self::faker()->randomNumber(),
            'categorie' => CategorieFactory::new(),
            'description' => self::faker()->text(255),
            'duree_moyenne' => self::faker()->randomNumber(),
            'nombre_joueurs' => self::faker()->randomNumber(),
            'titre' => self::faker()->text(50),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    #[\Override]
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(Jeu $jeu): void {})
        ;
    }
}
