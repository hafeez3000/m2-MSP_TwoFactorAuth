<?php
/**
 * MageSpecialist
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to info@magespecialist.it so we can send you a copy immediately.
 *
 * @category   MSP
 * @package    MSP_TwoFactorAuth
 * @copyright  Copyright (c) 2017 Skeeller srl (http://www.magespecialist.it)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace MSP\TwoFactorAuth\Block\Duo;

use Magento\Backend\Block\Template;
use MSP\TwoFactorAuth\Api\TfaInterface;
use MSP\TwoFactorAuth\Model\Provider\DuoSecurity;

class Auth extends Template
{
    /**
     * @var DuoSecurity
     */
    private $duoSecurity;

    /**
     * @var TfaInterface
     */
    private $tfa;

    public function __construct(
        Template\Context $context,
        TfaInterface $tfa,
        DuoSecurity $duoSecurity,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->duoSecurity = $duoSecurity;
        $this->tfa = $tfa;
    }

    /**
     * Get API hostname
     * @return string
     */
    public function getApiHost()
    {
        return $this->duoSecurity->getApiHostname();
    }

    /**
     * Get API signature
     * @return string
     */
    public function getSignature()
    {
        return $this->duoSecurity->getRequestSignature();
    }

    /**
     * Get post action
     * @return string
     */
    public function getPostAction()
    {
        return $this->getUrl('*/authpost/verify', ['form_key' => $this->getFormKey()]);
    }
}
