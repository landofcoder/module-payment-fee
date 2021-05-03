# Magento 2 Payment Fee
==============================

Payment Fee extension for Magento 2 allows adding extra charges for specific payment methods and displays them on the cart page, checkout page, invoice, and credit memo. Also, payment fees display in the sales email like new order, invoice, and credit memo. Admin can also set the payment fee in order creation from admin.

According to the payment method, there are several options for counting payment fees by percentage price, fixed price, per row and per item. The payment fee title and description are configurable from admin. Payment fees can be disabled after a specified maximum order amount. You can set the payment fee is refundable or not from the configurations settings. You can also set a default payment fee which acts as an extra fee on order. Payment fees may also be restricted only to specific stores or customer groups. Admin can access the payment fee configuration from Admin->Configuration->Landofcoder->Advanced Payment Fee.


New Features
==============================
<ul>
<li>Multi-store support</li>
<li>Multi-currency support</li>
<li>Support tax calculation on the payment fee</li>
<li>Allow admin to select tax class for the payment fee</li>
<li>Allow admin to select tax display type(Incl.,Excl.,both)</li>
<li>Customer group restrictions</li>
<li>Admin can set the sort order of payment fee</li>
<li>Calculate discount or shipping amount in subtotal</li>
</ul>

Features
==============================

<ul>
<li>Enable or disable extension from the admin configuration</li>
<li>Admin can add payment fees on specific payment methods</li>
<li>Supports major of common payment methods like Cash on Delivery, PayPal, etc.</li>
<li>Can add payment fees in:
  <ul>
    <li>Percentage Price
    <li>Fixed Price
    <li>Per Row
    <li>Per Item
  </ul>
</li>
<li>Admin can set custom payment fee title and description for easy understanding</li>
<li>Displays payment fee on the checkout page, Order page, Sales Email</li>
<li>Enable or disable refund of payment fees on credit memo from admin configuration</li> 
<li>Admin can disable payment fees on the maximum order amount by adding the max order amount from the admin configuration</li>
</ul>

# Demo

<b><a href="https://magento2.landofcoder.com/">Frontend</a>   |   <a href="http://magento2.landofcoder.com/admin">Backend</a></b>

# Installation Instruction

* Copy the content of the repo to the Magento 2 `app/code/Lof/Paymentfee`
* Run command:
<b>php bin/magento setup:upgrade</b>
* Run Command:
<b>php bin/magento setup:static-content:deploy</b>
* Now Flush Cache: <b>php bin/magento cache:flush</b>


# Contribution

Want to contribute to this extension? The quickest way is to <a href="https://help.github.com/articles/about-pull-requests/">open a pull request</a> on GitHub.

# Support

If you encounter any problems or bugs, please <a href="https://github.com/landofcoder/module-payment-fee/issues">open an issue</a> on GitHub.

# Screenshots

<h3>Checkout Page</h3>
<img src="./assets/checkout_page_2.png" />

<h3>Configuration</h3>
<img src="./assets/paymentfee-config1.jpg" />
<img src="./assets/paymentfee-config2.jpg" />


