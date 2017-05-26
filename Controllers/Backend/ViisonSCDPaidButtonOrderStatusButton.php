<?php
use Shopware\Models\Order\Order;
use Shopware\Models\Order\Status;
use Shopware\Plugins\ViisonCommon\Controllers\ViisonCommonBaseController;

/**
 * @copyright Copyright (c) 2017 VIISON GmbH
 */
class Shopware_Controllers_Backend_ViisonSCDPaidButtonOrderStatusButton extends ViisonCommonBaseController
{
    /**
     * Tries to find the order for the given 'orderId' and, if found, sets its payment status to 'completely paid'.
     */
    public function markAsPaidAction()
    {
        // Try to find the order
        $orderId = $this->Request()->getParam('orderId', 0);
        $order = $this->get('models')->find(Order::class, $orderId);
        if (!$order) {
            $this->Response()->setHttpResponseCode(404);
            $this->View()->assign([
                'success' => false,
                'message' => sprintf('Order with ID %s not found', $orderId)
            ]);
            return;
        }

        // Set the payment status to 'completely paid'
        $status = $this->get('models')->find(Status::class, Status::PAYMENT_STATE_COMPLETELY_PAID);
        $order->setPaymentStatus($status);
        $this->get('models')->flush($order);

        $this->View()->assign([
            'success' => true
        ]);
    }
}
