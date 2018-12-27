<?php
namespace App\Controller;
use App\Entity\Article;
use App\Entity\User;
use App\Service\SlackClient;
use App\Repository\ArticleRepository;
use App\Repository\CommentRepository;

use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Cache\Adapter\AdapterInterface;

class ArticleController extends AbstractController
{
	/**
     * Currently unused: just showing a controller with a constructor!
     */
    private $isDebug;
    private $slack;

	public function __construct(bool $isDebug, SlackClient $slack)
    {
        #dd($isDebug);
        $this->isDebug = $isDebug;
        $this->slack = $slack;
    }
	/**
	* @Route("/", name="app_homepage")
	*/
	public function homepage(ArticleRepository $repository)
	{
		#$repository = $em->getRepository(Article::class);
		#dd($repository);
        $articles = $repository->findAllPublishedOrderedByNewest();
        return $this->render('article/homepage.html.twig', ["articles"=>$articles]);
	}
	/**
	* @Route("/author/{email}/posts", name="app_author")
	*/
	public function byAuthor(User $user, ArticleRepository $repository)
	{
		$articles = $repository->findAllPublishedOrderedByNewest($user);
		return $this->render('article/homepage.html.twig', ["articles"=>$articles]);
	}

	/**
	* @Route("/news/{slug}", name="article_show")
	*/
	public function show(Article $article, SlackClient $slack)
	{
		if($article->getSlug() === "khaaaaaan") {
            $slack->sendMessage('Kahn', 'Ah, Kirk, my old friend...');
		}

        #$comments = $article->getComments();
        
		return $this->render('article/show.html.twig', [
			'article' => $article,
		]);
	}

	/**
	* @Route("/news/{slug}/heart", name="article_toggle_heart", methods={"POST"})
	*/
	public function toggleArticleHeart(Article $article, LoggerInterface $logger, EntityManagerInterface $em)
	{
		// TODO - actually heart/unheart the article!
        $logger->info('Article is being hearted!');
        $article->incrementHeartCount();
        $em->flush();
		return new JsonResponse(['hearts' => $article->getHeartCount()]);
	}
}