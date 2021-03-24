<?php
// post
// joindre comment_posts
// categorie
namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\CommentPost;
use App\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PostFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $faker = Factory::create('fr_FR');
        /**
         * Genere les categories
         */
        $categories = [];
        for ($i = 1; $i <= 30; $i++) {
            $category = new Category();
            $category->setName($faker->name);
            $manager->persist($category);
            $categories[] = $category;
        }
        // for ($i = 1; $i <= 5; $i++) {
        //     $category->setParentId($categories[]);
        // }

        // // les autres ont des sous categorie
        // $category->setParentId($categories[random_int(1, 9)]);
        /**
         * Genere les Posts
         */
        $posts = [];
        for ($i = 1; $i <= 30; $i++) {
            $post = new Post();
            $post->setCategory($categories[random_int(1, 9)]);
            $post->setContent($faker->sentence(6, 20));
            $post->setTitle($faker->name);
            $post->setStatus($faker->randomDigit(0, 1));
            $post->setCommentStatus($faker->randomDigit(0, 1));
            $post->setName($faker->name);
            $post->setCommentCount($faker->numberBetween(0, 30));
            $post->setUpdateDate($faker->dateTime);
            $post->setDate($faker->dateTime);
            $manager->persist($post);
            $posts[] = $post;
        }

        /**
         * Genere les Commentaire des posts
         */
        for ($i = 1; $i <= 30; $i++) {
            $commentPost = new CommentPost();
            $commentPost->setPost($posts[random_int(1, 9)]);
            // on va recuperer le user dans la fixture USER
            $user = $this->getReference('user_' . $faker->numberBetween(1, 30));
            $commentPost->setUser($user);
            $commentPost->setComPostDate($faker->dateTime);
            $commentPost->setComUpdateDate($faker->dateTime);
            $commentPost->setComPostContent($faker->paragraph(2));
            $manager->persist($commentPost);
        }

        $manager->flush();
    }
}
