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

namespace CCDNMessage\MessageBundle\Model\Model;

use Symfony\Component\Security\Core\User\UserInterface;

use CCDNMessage\MessageBundle\Model\Model\BaseModel;
use CCDNMessage\MessageBundle\Model\Model\ModelInterface;

use CCDNMessage\MessageBundle\Entity\Folder;
use CCDNMessage\MessageBundle\Entity\Envelope;
use CCDNMessage\MessageBundle\Entity\Message;
use CCDNMessage\MessageBundle\Entity\Thread;

/**
 *
 * @category CCDNMessage
 * @package  MessageBundle
 *
 * @author   Reece Fowell <reece@codeconsortium.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @version  Release: 2.0
 * @link     https://github.com/codeconsortium/CCDNMessageMessageBundle
 *
 */
class EnvelopeModel extends BaseModel implements ModelInterface
{
    /**
     *
     * @access public
     * @param  int                                        $envelopeId
     * @param  int                                        $userId
     * @return \CCDNMessage\MessageBundle\Entity\Envelope
     */
    public function findEnvelopeByIdForUser($envelopeId, $userId)
    {
		return $this->getRepository()->findEnvelopeByIdForUser($envelopeId, $userId);
    }

    /**
     *
     * @access public
     * @param  int                                                      $folderId
     * @param  int                                                      $userId
     * @param  int                                                      $page
     * @return \Knp\Bundle\PaginatorBundle\Pagination\SlidingPagination
     */
    public function findAllEnvelopesForFolderByIdPaginated($folderId, $userId, $page, $itemsPerPage = 25)
    {
		return $this->getRepository()->findAllEnvelopesForFolderByIdPaginated($folderId, $userId, $page, $itemsPerPage);
    }

    /**
     *
     * @access public
     * @param  int                                          $envelopeId
     * @param  int                                          $userId
     * @return \Doctrine\Common\Collections\ArrayCollection
     *
     */
    public function findTheseEnvelopesByIdAndByUserId($envelopeIds, $userId)
    {
		return $this->getRepository()->findTheseEnvelopesByIdAndByUserId($envelopeIds, $userId);
	}

    /**
     *
     * @access public
     * @param  int     $folderId
     * @param  int     $userId
     * @return array
     */
    public function getReadCounterForFolderById($folderId, $userId)
    {
		return $this->getRepository()->getReadCounterForFolderById($folderId, $userId);
    }

    /**
     *
     * @access public
     * @param  int     $folderId
     * @param  int     $userId
     * @return array
     */
    public function getUnreadCounterForFolderById($folderId, $userId)
    {
		return $this->getRepository()->getUnreadCounterForFolderById($folderId, $userId);
    }

    const MESSAGE_SEND = 0;
    const MESSAGE_SAVE_CARBON_COPY = 1;
    const MESSAGE_SAVE_DRAFT = 2;

    private $sendMode = array(
        self::MESSAGE_SEND,
        self::MESSAGE_SAVE_CARBON_COPY,
        self::MESSAGE_SAVE_DRAFT,
    );

	/**
	 * 
	 * @access public
	 * @param  \CCDNMessage\MessageBundle\Entity\Envelope
	 */
	public function saveEnvelope(Envelope $envelope)
	{
		return $this->getManager()->saveEnvelope($envelope);
	}

    /**
     *
     * @access public
     * @param  \CCDNMessage\MessageBundle\Entity\Envelope               $envelope
     * @param  array                                                    $folders
     * @return \CCDNMessage\MessageBundle\Model\Manager\EnvelopeManager
     */
    public function markAsRead(Envelope $envelope, $folders)
    {
		return $this->getManager()->markAsRead($envelope, $folders);
    }

    /**
     *
     * @access public
     * @param  array                                                    $envelopes
     * @param  array                                                    $folders
     * @return \CCDNMessage\MessageBundle\Model\Manager\EnvelopeManager
     */
    public function bulkMarkAsRead($envelopes, $folders)
    {
		return $this->getManager()->bulkMarkAsRead($envelopes, $folders);
    }

    /**
     *
     * @access public
     * @param  Envelope                                                 $envelope
     * @param  array                                                    $folders
     * @return \CCDNMessage\MessageBundle\Model\Manager\EnvelopeManager
     */
    public function markAsUnread(Envelope $envelope, $folders)
    {
		return $this->getManager()->markAsUnread($envelope, $folders);
    }

    /**
     *
     * @access public
     * @param  array                                                    $envelopes
     * @param  array                                                    $folders
     * @return \CCDNMessage\MessageBundle\Model\Manager\EnvelopeManager
     */
    public function bulkMarkAsUnread($envelopes, $folders)
    {
		return $this->getManager()->bulkMarkAsUnread($envelopes, $folders);
    }

    /**
     *
     * @access public
     * @param  \CCDNMessage\MessageBundle\Entity\Envelope               $envelope
     * @param  array                                                    $folders
     * @return \CCDNMessage\MessageBundle\Model\Manager\EnvelopeManager
     */
    public function delete(Envelope $envelope, $folders)
    {
		return $this->getManager()->delete($envelope, $folders);
    }

    /**
     *
     * @access public
     * @param  array                                                    $envelopes
     * @param  array                                                    $folders
     * @param  \Symfony\Component\Security\Core\User\UserInterfaces     $user
     * @return \CCDNMessage\MessageBundle\Model\Manager\EnvelopeManager
     */
    public function bulkDelete($envelopes, $folders, UserInterface $user)
    {
		return $this->getManager()->bulkDelete($envelopes, $folders, $user);
    }

    /**
     *
     * @access public
     * @param  array                                                    $envelopes
     * @param  \CCDNMessage\MessageBundle\Entity\Folder                 $moveTo
     * @return \CCDNMessage\MessageBundle\Model\Manager\EnvelopeManager
     */
    public function bulkMoveToFolder($envelopes, Folder $moveTo)
    {
		return $this->getManager()->bulkMoveToFolder($envelopes, $moveTo);
    }
}