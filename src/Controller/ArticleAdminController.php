<?php
namespace App\Controller;
use App\Entity\Article;

use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * @IsGranted("ROLE_ADMIN")
 */
class ArticleAdminController extends AbstractController
{
	/**
     * @Route("/admin/article/new", name="admin_article_new")
     */
	public function new(EntityManagerInterface $em)
	{
		die('todo');
	}
}