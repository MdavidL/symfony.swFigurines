<?php

namespace App\Controller;

use App\Repository\ProductaddRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class EpisodeController extends AbstractController
{
    /**
     * @Route ("/episode4", name="public_episode_4")
     */
    //I create a public function for episode 4, for my Controller.
    public function episode4(ProductaddRepository $productaddRepository)
    {
        // we get back the right products with the ID episode
        $episode4 = $productaddRepository->findBy(['episode_id' => '4']);
        // I create a view in order to display result
        return $this->render('public/episode4.html.twig', ['episode4'=>$episode4]);
    }

    /**
     * @Route ("/episode1", name="public_episode_1")
     */
    public function episode1(ProductaddRepository $productaddRepository)
    {

        $episode1 = $productaddRepository->findBy(['episode_id' => '1']);

        return $this->render('public/episode1.html.twig', ['episode1'=>$episode1]);
    }

    /**
     * @Route ("/episode3", name="public_episode_3")
     */
    public function episode3(ProductaddRepository $productaddRepository)
    {

        $episode3 = $productaddRepository->findBy(['episode_id' => '3']);

        return $this->render('public/episode3.html.twig', ['episode3'=>$episode3]);
    }

    /**
     * @Route ("/episoderogueone", name="public_episode_rogueone")
     */
    public function episode10(ProductaddRepository $productaddRepository)
    {

        $episode10 = $productaddRepository->findBy(['episode_id' => '10']);

        return $this->render('public/episode-rogueone.html.twig', ['episode10'=>$episode10]);
    }

    /**
     * @Route ("/episodemandalorian", name="public_episode_mandalorian")
     */
    public function episode11(ProductaddRepository $productaddRepository)
    {

        $episode11 = $productaddRepository->findBy(['episode_id' => '11']);

        return $this->render('public/episode-mandalorian.html.twig', ['episode11'=>$episode11]);
    }


}