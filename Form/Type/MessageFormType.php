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

namespace CCDNMessage\MessageBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

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
class MessageFormType extends AbstractType
{
    /**
     *
     * @access protected
     * @var string $messageClass
     */
    protected $messageClass;

    /**
     *
     * @access public
     * @var string $messageClass
     */
    public function __construct($messageClass)
    {
        $this->messageClass = $messageClass;
    }

    /**
     *
     * @access public
     * @param FormBuilder $builder, array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('send_to', 'text',
                array(
                    'data'               => $options['send_to'],
                    'label'              => 'ccdn_message_message.form.label.message.to',
                    'translation_domain' => 'CCDNMessageMessageBundle',
                )
            )
            ->add('subject', 'text',
                array(
                    'data'               => $options['subject'],
                    'label'              => 'ccdn_message_message.form.label.message.subject',
                    'translation_domain' => 'CCDNMessageMessageBundle',
                )
            )
            ->add('body', 'textarea',
                array(
                    'data'               => $options['body'],
                    'label'              => 'ccdn_message_message.form.label.message.body',
                    'translation_domain' => 'CCDNMessageMessageBundle',
                )
            )
            ->add('is_flagged', 'checkbox',
                array(
                    'required'           => false,
                    'mapped'             => false,
                    'property_path'      => false,
                    'label'              => 'ccdn_message_message.form.label.message.flagged',
                    'translation_domain' => 'CCDNMessageMessageBundle',
                )
            )
        ;

        //$userId = $this->defaults['sender']->getId();
        //$attachments = $this->container->get('ccdn_component_attachment.repository.attachment')->findForUserByIdAsQB($userId);
        //
        //$builder->add('attachment', 'entity', array(
        //    'class' => 'CCDNComponentAttachmentBundle:Attachment',
        //    'choices' => $attachments,
        //    'property' => 'filename_original',
        //    'required' => false,
        //    )
        //);
    }

    /**
     *
     * @access public
     * @param  array $options
     * @return array
     */
    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class'         => $this->messageClass,
            'csrf_protection'    => true,
            'csrf_field_name'    => '_token',
            // a unique key to help generate the secret token
            'intention'          => 'message_item',
            'validation_groups'  => array('message_send'),
            'send_to'            => '',
            'subject'            => '',
            'body'               => '',
        );
    }

    /**
     *
     * @access public
     * @return string
     */
    public function getName()
    {
        return 'Message';
    }
}
