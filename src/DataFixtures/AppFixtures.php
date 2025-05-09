<?php

namespace App\DataFixtures;

use App\Entity\Formations;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $formations = [
            [
                'title' => 'Leadership et Management',
                'description' => 'Devenez un leader inspirant et stratégique.',
                'price' => 1999.99,
                'category' => 'Management',
                'image_url' => '/uploads/formations/leadership.jpg'
            ],
            [
                'title' => 'Data Science pour Managers',
                'description' => 'Comprendre les enjeux de la Data Science pour la gestion d\'entreprise.',
                'price' => 2499.00,
                'category' => 'Data',
                'image_url' => '/uploads/formations/datascience.jpg'
            ],
            [
                'title' => 'Finance d’Entreprise Avancée',
                'description' => 'Maîtriser l’analyse financière de haut niveau.',
                'price' => 2299.00,
                'category' => 'Finance',
                'image_url' => '/uploads/formations/finance.jpg'
            ],
            [
                'title' => 'Marketing Digital Stratégique',
                'description' => 'Maîtrisez les outils du marketing moderne.',
                'price' => 1799.00,
                'category' => 'Marketing',
                'image_url' => '/uploads/formations/marketing.jpg'
            ],
            [
                'title' => 'Cybersécurité pour Entreprises',
                'description' => 'Protégez vos données et infrastructures sensibles.',
                'price' => 2699.00,
                'category' => 'Informatique',
                'image_url' => '/uploads/formations/cybersecurite.jpg'
            ],
            [
                'title' => 'Négociation Internationale',
                'description' => 'Excellez dans les négociations globales.',
                'price' => 2599.00,
                'category' => 'Commerce International',
                'image_url' => '/uploads/formations/negociation.jpg'
            ],
        ];

        foreach ($formations as $data) {
            $formation = new Formations();
            $formation->setTitle($data['title']);
            $formation->setDescription($data['description']);
            $formation->setPrice($data['price']);
            $formation->setCategory($data['category']);
            $formation->setImageUrl($data['image_url']);
            $formation->setCreatedAt(new \DateTimeImmutable());
            $formation->setUpdatedAt(new \DateTimeImmutable());

            $manager->persist($formation);
        }

        $manager->flush();
    }
}
