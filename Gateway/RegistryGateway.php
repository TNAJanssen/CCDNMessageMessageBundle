<?php

/*
 * This file is part of the CCDNMessage MessageBundle
 *
 * (c) CCDN (c) CodeConsortium <http://www.codeconsortium.com/>
 *
 * Available on github <http://www.github.com/codeconsortium/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CCDNMessage\MessageBundle\Gateway;

use Doctrine\ORM\QueryBuilder;

use CCDNMessage\MessageBundle\Gateway\BaseGatewayInterface;
use CCDNMessage\MessageBundle\Gateway\BaseGateway;
use CCDNMessage\MessageBundle\Gateway\Bag\GatewayBag;

use CCDNMessage\MessageBundle\Entity\Registry;

/**
 *
 * @author Reece Fowell <reece@codeconsortium.com>
 * @version 1.0
 */
class RegistryGateway extends BaseGateway implements BaseGatewayInterface
{
	/**
	 *
	 * @access private
	 * @var string $entityClass
	 */
	private $entityClass = 'CCDNMessage\MessageBundle\Entity\Registry';
	
	/**
	 *
	 * @access private
	 * @var string $queryAlias
	 */
	private $queryAlias = 'r';

	/**
	 *
	 * @access public
	 * @return string
	 */
	public function getEntityClass()
	{
		return $this->entityClass;
	}
	
	/**
	 *
	 * @access public
	 * @param \Doctrine\ORM\QueryBuilder $qb
	 * @param Array $parameters
	 * @return \Doctrine\Common\Collections\ArrayCollection
	 */
	public function findRegistry(QueryBuilder $qb = null, $parameters = null)
	{
		if (null == $qb) {
			$qb = $this->createSelectQuery();
		}
						
		return $this->one($qb, $parameters);
	}
	
	/**
	 *
	 * @access public
	 * @param \Doctrine\ORM\QueryBuilder $qb
	 * @param Array $parameters
	 * @return \Doctrine\Common\Collections\ArrayCollection
	 */
	public function findRegistries(QueryBuilder $qb = null, $parameters = null)
	{
		if (null == $qb) {
			$qb = $this->createSelectQuery();
		}

		$qb->addOrderBy('r.cachedUnreadMessagesCount', 'ASC');
		
		return $this->all($qb, $parameters);
	}
	
	/**
	 *
	 * @access public
	 * @param \Doctrine\ORM\QueryBuilder $qb
	 * @param Array $parameters
	 * @return int
	 */
	public function countRegistries(QueryBuilder $qb = null, $parameters = null)
	{
		if (null == $qb) {
			$qb = $this->createCountQuery();
		}
		
		if (null == $parameters) {
			$parameters = array();
		}
		
		$qb->setParameters($parameters);

		try {
			return $qb->getQuery()->getSingleScalarResult();
		} catch (\Doctrine\ORM\NoResultException $e) {
			return 0;
		}
	}
	
	/**
	 *
	 * @access public
	 * @param string $column = null
	 * @param Array $aliases = null
	 * @return \Doctrine\ORM\QueryBuilder
	 */	
	public function createCountQuery($column = null, Array $aliases = null)
	{
		if (null == $column) {
			$column = 'count(' . $this->queryAlias . '.id)';
		}
		
		if (null == $aliases || ! is_array($aliases)) {
			$aliases = array($column);
		}
		
		if (! in_array($column, $aliases)) {
			$aliases = array($column) + $aliases;
		}

		return $this->getQueryBuilder()->select($aliases)->from($this->entityClass, $this->queryAlias);
	}
	
	/**
	 *
	 * @access public
	 * @param Array $aliases = null
	 * @return \Doctrine\ORM\QueryBuilder
	 */	
	public function createSelectQuery(Array $aliases = null)
	{
		if (null == $aliases || ! is_array($aliases)) {
			$aliases = array($this->queryAlias);
		}
		
		if (! in_array($this->queryAlias, $aliases)) {
			$aliases = array($this->queryAlias) + $aliases;
		}
		
		return $this->getQueryBuilder()->select($aliases)->from($this->entityClass, $this->queryAlias);
	}
	
	/**
	 *
	 * @access public
	 * @param \CCDNMessage\MessageBundle\Entity\Registry $registry
	 * @return \CCDNMessage\MessageBundle\Gateway\BaseGatewayInterface
	 */	
	public function persistRegistry(Registry $registry)
	{
		$this->persist($registry)->flush();
		
		return $this;
	}
	
	/**
	 *
	 * @access public
	 * @param \CCDNMessage\MessageBundle\Entity\Registry $registry
	 * @return \CCDNMessage\MessageBundle\Gateway\BaseGatewayInterface
	 */	
	public function updateRegistry(Registry $registry)
	{
		$this->persist($registry)->flush();
		
		return $this;
	}
	
	/**
	 *
	 * @access public
	 * @param \CCDNMessage\MessageBundle\Entity\Registry $registry
	 * @return \CCDNMessage\MessageBundle\Gateway\BaseGatewayInterface
	 */	
	public function deleteRegistry(Registry $registry)
	{
		$this->remove($registry)->flush();
		
		return $this;
	}
}