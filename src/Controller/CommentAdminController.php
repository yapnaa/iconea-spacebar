<?php

namespace App\Controller;
use App\Repository\CommentRepository;

use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CommentAdminController extends AbstractController
{
    /**
     * @Route("/admin/comment", name="comment_admin")
     */
    public function index(CommentRepository $repository, Request $request, PaginatorInterface $paginator)
    {
    	$q = $request->query->get('q');
    	#$comments = $repository->findBy([], ['createdAt' => 'DESC']);
    	#$comments = $repository->findAllWithSearch($q);

    	$queryBuilder = $repository->getWithSearchQueryBuilder($q);
    	
    	$pagination = $paginator->paginate(
            $queryBuilder, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            10/*limit per page*/
        );

        $pagination->setCustomParameters(array(
            'align' => 'center', # center|right (for template: twitter_bootstrap_v4_pagination)
            #'size' => 'small', # small|large (for template: twitter_bootstrap_v4_pagination)
            'style' => 'top',
            'span_class' => 'whatever'
        ));

        return $this->render('comment_admin/index.html.twig', [
            'pagination' => $pagination,
        ]);
    }
}
