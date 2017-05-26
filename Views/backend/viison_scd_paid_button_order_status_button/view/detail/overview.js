//{namespace name=backend/viison_scd_paid_button_order_status_button}
Ext.define('Shopware.apps.ViisonSCDPaidButtonOrderStatusButton.view.detail.Overview', {

    override: 'Shopware.apps.Order.view.detail.Overview',

    /**
     * @override
     */
    createDetailsContainer: function() {
        var container = this.callParent(arguments);

        // Add a 'mark as paid' unicorn button
        container.add(Ext.create('Shopware.apps.ViisonSCDOrderButtonUnicornButton.Button', {
            text: '{s name=view/detail/button/mark_as_paid/title}{/s}',
            scope: this,
            handler: function() {
                var window = this.up('order-detail-window');
                window.setLoading(true);

                // Send a request for updating the order
                Ext.Ajax.request({
                    method: 'PUT',
                    params: {
                        orderId: this.record.get('id')
                    },
                    url: '{url controller=ViisonSCDPaidButtonOrderStatusButton action=markAsPaid}',
                    success: function() {
                        window.setLoading(false);
                        Shopware.Notification.createGrowlMessage('{s name=view/detail/button/mark_as_paid/notification/success}{/s}', '', 'ViisonSCDPaidButton');
                    },
                    failure: function() {
                        window.setLoading(false);
                        Shopware.Notification.createGrowlMessage('{s name=view/detail/button/mark_as_paid/notification/failure}{/s}', '', 'ViisonSCDPaidButton');
                    }
                });
            }
        }));

        return container;
    }

});
