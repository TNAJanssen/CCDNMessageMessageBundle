<?php

/*
 * This file is part of the CCDN MessageBundle
 *
 * (c) CCDN (c) CodeConsortium <http://www.codeconsortium.com/> 
 * 
 * Available on github <http://www.github.com/codeconsortium/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CCDNMessage\MessageBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;

/**
 * RegistryRepository
 *
 * 
 * @author Reece Fowell <reece@codeconsortium.com> 
 * @version 1.0
 */
class RegistryRepository extends EntityRepository
{
	
	
	/**
	 *
	 * @access public
	 * @param int $folder_id
	 */
	public function findRegistryRecordForUser($user_id)
	{
		$query = $this->getEntityManager()
			->createQuery('	
				SELECT r
				FROM CCDNMessageMessageBundle:Registry r
				WHERE r.owned_by = :id
				')
			->setParameter('id', $user_id);

		try {
	        return $query->getSingleResult();
	    } catch (\Doctrine\ORM\NoResultException $e) {
	        return;
	    }
	}
	
}