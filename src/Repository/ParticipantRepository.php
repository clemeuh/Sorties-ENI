<?php

namespace App\Repository;

use App\Entity\Participant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @method Participant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Participant|null findOneBy(array $criteria, array $orderBy = null)
 * @method Participant[]    findAll()
 * @method Participant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParticipantRepository extends ServiceEntityRepository implements PasswordUpgraderInterface,UserLoaderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Participant::class);
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(UserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof Participant) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }

        $user->setPassword($newHashedPassword);
        $this->_em->persist($user);
        $this->_em->flush();
    }

    public function loadUserByUsername($usernameOrEmail)#: ?Participant
    {
        return $this->createQueryBuilder('u')
            ->Where('u.pseudo = :param')
            ->orWhere('u.mail = :param')
            ->setParameter('param', $usernameOrEmail)
            ->getQuery()
            ->getOneOrNullResult();
    }

  /*  /**
     * Return a user based on mail or username
     * @param $username
     * @throws NonUniqueResultException
     */

/*public function loadUserByUsername(string $username)
{
    return $this->createQueryBuilder("u")
    ->where("u.pseudo = :query")
    ->orWhere("u.mail = :query")
    ->setParameter("query", $username)
    ->getQuery()
    ->getOneOrNullResult();

} */

}