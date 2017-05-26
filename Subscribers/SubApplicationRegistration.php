<?php
namespace Shopware\Plugins\ViisonSCDPaidButton\Subscribers;

use Shopware\Plugins\ViisonCommon\Classes\Subscribers\SubApplicationRegistration as SubApplicationRegistrationSubscriber;

/**
 * @copyright Copyright (c) 2017, VIISON GmbH
 */
class SubApplicationRegistration extends SubApplicationRegistrationSubscriber
{
    /**
     * @inheritdoc
     */
    public function getSubApplications()
    {
        return [
            'ViisonSCDPaidButtonOrderStatusButton' => [
                'Order',
                [
                    'ViisonSCDOrderButtonUnicornButton'
                ]
            ]
        ];
    }
}
