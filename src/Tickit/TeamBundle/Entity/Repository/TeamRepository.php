<?php

namespace Tickit\TeamBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Team repository.
 *
 * Provides methods for fetching Team related data from the DBAL
 *
 * @package Tickit\TeamBundle\Entity\Repository
 * @author  James Halsall <james.t.halsall@googlemail.com>
 */
class TeamRepository extends EntityRepository
{

    /**
     * Returns a query that fetches all teams in the system that match a set of specific filters
     *
     * @param array $options
     *
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getFiltered(array $options)
    {
        $qb = $this->getEntityManager()
                   ->createQueryBuilder();

        $query = $qb->select('t.id, t.name, t.created, t.updated')
                    ->from('TickitTeamBundle:Team', 't');

        if (!empty($options['name'])) {
            $query->expr()->like('t.name', $query->expr()->literal($options['name']));
        }

        return $query;
    }
}
