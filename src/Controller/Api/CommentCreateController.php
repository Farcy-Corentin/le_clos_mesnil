<?php


namespace App\Controller\Api;

use App\Entity\Users;
use App\Entity\CommentPost;
use Symfony\Component\Security\Core\Security;

class CommentCreateController
{

    private Security $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function __invoke(CommentPost $data)
    {

        $data->getUser();
        dd($data);

    }
}