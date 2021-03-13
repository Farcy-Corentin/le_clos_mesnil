<?php


namespace App\Security;


use App\Entity\CommentPost;
use App\Entity\Users;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class CommentVoter extends Voter
{
    const EDIT = 'EDIT_COMMENT';
    /**
     * @inheritDoc
     */
    protected function supports(string $attribute, $subject)
    {
        $attribute === self::EDIT &&
        $subject instanceof CommentPost;
    }

    /**
     * @inheritDoc
     */
    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();
        if (!$user instanceof Users ||
            !$subject instanceof CommentPost
        ) {
            return false;
        }
        return $subject->getAuthor()->getId() === $user->getId();
    }
}