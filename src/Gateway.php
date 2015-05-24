<?php
namespace Adee2210\Netbanx;

use Adee2210\Common\GatewayCore;
use Adee2210\Common\GatewayTemplate;

class Gateway extends GatewayCore implements GatewayTemplate
{

    public function __construct(){
        return $this->setConfig() && $this->setVars() && $this->setName();
    }

	private function setName(){
		return $this->name = 'Optimal Payment Gateway';
	}

    private function setConfig($args = array()){
        return $this->configs = array(
            'ccAuthRequestV1' => array(
                'args'=>array(
                    'merchantAccount.accountNum',
                    'merchantAccount.storeID',
                    'merchantAccount.storePwd',
                    'merchantRefNum',
                    'amount',
                    'card.cardNum',
                    'card.cardExpiry.month',
                    'card.cardExpiry.year',
                    'card.cvd',
                    'billingDetails.cardPayMethod',
                    'billingDetails.firstName',
                    'billingDetails.lastName',
                    'billingDetails.companyName',
                    'billingDetails.street',
                    'billingDetails.street2',
                    'billingDetails.city',
                    'billingDetails.state',
                    'billingDetails.region',
                    'billingDetails.country',
                    'billingDetails.zip',
                    'billingDetails.phone',
                    'billingDetails.email'
                ),
                'description'=>'Allows you to credit an amount to a customer’s credit card. The Payment transaction is not associated with a previously existing authorization, so the amount of the transaction is not restricted in this way.',
                'url'=>'https://webservices.test.optimalpayments.com/creditcardWS/CreditCardServlet/v1',
                'xmlns'=>'http://www.optimalpayments.com/creditcard/xmlschema/v1',
                'txnMode'=>'ccPurchase',
                'optional'=>array(
                    'billingDetails.cardPayMethod',
                    'billingDetails.firstName',
                    'billingDetails.lastName',
                    'billingDetails.companyName',
                    'billingDetails.street',
                    'billingDetails.street2',
                    'billingDetails.city',
                    'billingDetails.state',
                    'billingDetails.region',
                    'billingDetails.country',
                    'billingDetails.phone',
                    'billingDetails.email'
                ),
                'response'=>'ccTxnResponseV1'
            ),
            'ddMandateRequestV1' => array(
                'args'=>array(
                    'merchantAccount.accountNum',
                    'merchantAccount.storeID',
                    'merchantAccount.storePwd',
                    'merchantRefNum',
                    'check.accountNum',
                    'check.routingNum',
                    'check.bankCountry',
                    'check.bankCity',
                    'check.mandateReference',
                    'billingDetails.firstName',
                    'billingDetails.lastName',
                    'billingDetails.region',
                    'autoSend',
                ),
                'description'=>'Allows you to credit an amount to a customer’s credit card. The Payment transaction is not associated with a previously existing authorization, so the amount of the transaction is not restricted in this way.',
                'url'=>'https://webservices.test.optimalpayments.com/directdebitWS/DirectDebitServlet/v1',
                'xmlns'=>'http://www.optimalpayments.com/directdebit/xmlschema/v1',
                'txnMode'=>'mandate',
                'optional'=>array(
                    'billingDetails.street2',
                    'billingDetails.region',
                ),
                'response'=>'ddCheckResponseV1'
            ),
            'ddCheckRequestV1' => array(
                'args'=>array(
                    'merchantAccount.accountNum',
                    'merchantAccount.storeID',
                    'merchantAccount.storePwd',
                    'merchantRefNum',
                    'amount',
                    'check.accountType',
                    'check.bankName',
                    'check.checkNum',
                    'check.accountNum',
                    'check.routingNum',
                    'check.mandateReference',
                    'billingDetails.checkPayMethod',
                    'billingDetails.firstName',
                    'billingDetails.lastName',
                    'billingDetails.companyName',
                    'billingDetails.street',
                    'billingDetails.street2',
                    'billingDetails.city',
                    'billingDetails.state',
                    'billingDetails.region',
                    'billingDetails.country',
                    'billingDetails.zip',
                    'billingDetails.phone',
                    'billingDetails.email',
                    'txnDate', /* BACS needed +5 days*/
                ),
                'description'=>'Allows you to credit an amount to a customer’s credit card. The Payment transaction is not associated with a previously existing authorization, so the amount of the transaction is not restricted in this way.',
                'url'=>'https://webservices.test.optimalpayments.com/directdebitWS/DirectDebitServlet/v1',
                'xmlns'=>'http://www.optimalpayments.com/directdebit/xmlschema/v1',
                'txnMode'=>'charge',
                'footer'=>'<sdk>'.PHP_EOL.'<version>1.0</version>'.PHP_EOL.'<platform>http</platform>'.PHP_EOL.'<provider>Merchant</provider>'.PHP_EOL.'</sdk>'.PHP_EOL,
                'optional'=>array(
                    'check.bankCountry',
                    'check.bankCity',
                    'check.mandateReference',
                    'billingDetails.companyName',
                    'billingDetails.street2',
                    'billingDetails.state',
                    'billingDetails.region',
                ),
                'response'=>'ddCheckResponseV1'
            ),
            'ddLookupRequestV1' => array(
                'args'=>array(
                    'merchantAccount.accountNum',
                    'merchantAccount.storeID',
                    'merchantAccount.storePwd',
                    'confirmationNumber',
                    'merchantRefNum',
                    'startDate.year',
                    'startDate.month',
                    'startDate.day',
                    'startDate.hour',
                    'startDate.minute',
                    'startDate.second',
                    'endDate.year',
                    'endDate.month',
                    'endDate.day',
                    'endDate.hour',
                    'endDate.minute',
                    'endDate.second',
                ),
                'description'=>'The Direct Debit lookup request allows you to run a report, over a date range you specify, to return data on Direct Debit charge and credit transactions processed through your merchant account.',
                'url'=>'https://webservices.test.optimalpayments.com/directdebitWS/DirectDebitServlet/v1',
                'xmlns'=>'http://www.optimalpayments.com/directdebit/xmlschema/v1',
                'txnMode'=>'lookup',
                'footer'=>'',//'<sdk>'.PHP_EOL.'<version>1.0</version>'.PHP_EOL.'<platform>http</platform>'.PHP_EOL.'<provider>Merchant</provider>'.PHP_EOL.'</sdk>'.PHP_EOL,
                'optional'=>array(
                    'confirmationNumber',
                ),
                'response'=>'ddCheckResponseV1'
            ),
        );
    }

    private function setVars($args = array()){
        return $this->vars = array(
            'form'=>array(
                'merchantAccount.accountNum' => array(
                        'type'=>'text',
                        'description'=>'This is the merchant account number.',
                ),
                'merchantAccount.storeID' => array(
                        'type'=>'text',
                        'description'=>'This is the NETBANX store identifier, used to authenticate the request. It is defined by NETBANX and provided to the merchant as part of the integration process.',
                ),
                'merchantAccount.storePwd' => array(
                        'type'=>'text',
                        'description'=>'This is the NETBANX store password, used to authenticate the request. It is defined by NETBANX and provided to the merchant as part of the integration process.',
                ),
                'merchantRefNum' => array(
                        'type'=>'text',
                        'description'=>'This is a unique ID number associated with each request. The value is created by the merchant and submitted as part of the request.',
                ),
                'amount' => array(
                        'type'=>'text',
                        'description'=>'This is amount of the transaction request. NOTE: Though mandatory, this value will be ignored for the ccVerification transaction.',
                ),
                'card.cardNum' => array(
                        'type'=>'text',
                        'description'=>'This is the card number used for the transaction.'
                ),
                'card.cardExpiry.month' => array(
                        'type'=>'text',
                        'description'=>'This is the month the credit card expires.'
                ),
                'card.cardExpiry.year' => array(
                        'type'=>'text',
                        'description'=>'This is the year the credit card expires.'
                ),
                'card.cvd' => array(
                        'type'=>'text',
                        'description'=>'    The 3- or 4-digit security code that appears on the card following the card number. This code does not appear on imprints.
                        NOTE: The cvd element is mandatory when the cvdIndicator element value = 1.'
                ),
                'check.accountType' => array(
                        'type'=>'select',
                        'default'=>array('PC'=>'PC (Personal Checking)','PS'=>'PS (Personal Savings)','PL'=>'PL (Personal Loan)','BC'=>'BC (Business Checking)','BS'=>'BS (Business Savings)','BL'=>'BL (Business Loan)'),
                        'description'=>'This is the type of checking account used for the transaction. Possible values are:
                        PC (Personal Checking)
                        PS (Personal Savings)
                        PL (Personal Loan)
                        BC (Business Checking)
                        BS (Business Savings)
                        BL (Business Loan)',
                ),
                'check.bankName' => array(
                        'type'=>'text',
                        'description'=>'This is the name of the customer’s bank, to which this transaction is posted.',
                ),
                'check.checkNum' => array(
                        'type'=>'text',
                        'description'=>'This is the check serial number, provided at the time of the transaction request.
                        NOTE: The checkNum element is required for the verify operation, where it serves as a unique transaction ID, even though no money is transferred between accounts for this operation.',
                ),
                'check.accountNum' => array(
                        'type'=>'text',
                        'description'=>'This is the customer’s bank account number.',
                ),
                'check.routingNum' => array(
                        'type'=>'text',
                        'description'=>'For USD accounts, this is the 9-digit routing number of the customer’s bank.
                        For British pound accounts, this is the 6-digit sort code of the customer’s bank.
                        For Canadian dollar accounts, this is a combination of the 3-digit institution ID followed by the 5-digit transit number of the customer’s bank branch. They must be entered in this order. Do not include spaces or dashes.',
                ),
                'check.bankCountry' => array(
                        'type'=>'text',
                        'description'=>'This is the country in which the bank is located. See Country codes for correct codes to use. This is a required element only for certain countries.',
                ),
                'check.bankCity' => array(
                        'type'=>'text',
                        'description'=>'This is the city in which the bank is located. This is a required element only for certain countries.',
                ),
                'check.mandateReference' => array(
                        'type'=>'text',
                        'description'=>'This is the mandate reference that allows the U.K. account to be charged. This is the value returned for the confirmationNumber parameter in the response to a ddMandateRequestV1.'
                ),
                'check.mandateReference' => array(
                        'type'=>'text',
                        'description'=>'',
                ),
                'billingDetails.checkPayMethod' => array(
                        'type'=>'select',
                        'default'=>array('WEB'=>'WEB','TEL'=>'TEL','PPD'=>'PPD','CCD'=>'CCD'),
                        'description'=>'This is the payment type. Possible values are:
                        WEB (Personal Check Only)
                        TEL (Personal Check Only)
                        PPD (Personal Check Only)
                        CCD (Business Check Only)',
                ),
                'billingDetails.cardPayMethod' => array(
                        'type'=>'select',
                        'default'=>array('WEB'=>'WEB','TEL'=>'TEL','PPD'=>'PPD','CCD'=>'CCD'),
                        'description'=>'This is the payment type. Possible values are:
                        WEB (Personal Check Only)
                        TEL (Personal Check Only)
                        PPD (Personal Check Only)
                        CCD (Business Check Only)'
                ),
                'billingDetails.firstName' => array(
                        'type'=>'text',
                        'description'=>'This is the customer’s first name.
                        Required if checkPayMethod is set to WEB or TEL.',
                ),
                'billingDetails.lastName' => array(
                        'type'=>'text',
                        'description'=>'This is the customer’s last name.
                        Required if checkPayMethod is set to WEB or TEL.',
                ),
                'billingDetails.companyName' => array(
                        'type'=>'text',
                        'description'=>'This is the company’s name.
                        Required if checkPayMethod is a business check.'
                ),
                'billingDetails.street' => array(
                        'type'=>'text',
                        'description'=>'This is the first line of the customer’s street address.',
                ),
                'billingDetails.street2' => array(
                        'type'=>'text',
                        'description'=>'This is the second line of the customer’s street address.',
                ),
                'billingDetails.city' => array(
                        'type'=>'text',
                        'description'=>'This is the city in which the customer resides.',
                ),
                'billingDetails.state' => array(
                        'type'=>'text',
                        'description'=>'This is the state/province/region in which the customer resides.
                        Provide state if within U.S./Canada. Provide region if outside of U.S./Canada.
                        See Geographical Codes for correct codes to use.'
                ),
                'billingDetails.region' => array(
                        'type'=>'text',
                        'description'=>'This is the state/province/region in which the customer resides.
                        Provide state if within U.S./Canada. Provide region if outside of U.S./Canada.
                        See Geographical Codes for correct codes to use.',
                ),
                'billingDetails.country' => array(
                        'type'=>'text',
                        'description'=>'This is the country in which the customer resides. See Country codes for correct codes to use.',
                ),
                'billingDetails.zip' => array(
                        'type'=>'text',
                        'description'=>'This is the customer’s ZIP code if in the U.S.; otherwise, this is the customer’s postal code.',
                ),
                'billingDetails.phone' => array(
                        'type'=>'text',
                        'description'=>'This is the customer’s telephone number.',
                ),
                'billingDetails.email' => array(
                        'type'=>'text',
                        'description'=>'This is the customer’s email address.'
                ),
                'confirmationNumber' => array(
                        'type'=>'text',
                        'description'=>'This is the confirmation number returned by NETBANX in response to the original request. Include this element only if you want to search using this field. This field takes precedence over the merchantRefNum field.'
                ),
                'startDate.year' => array(
                        'type'=>'text',
                        'description'=>'This is the year set for the search start.',
                ),
                'startDate.month' => array(
                        'type'=>'text',
                        'description'=>'This is the month set for the search start.',
                ),
                'startDate.day' => array(
                        'type'=>'text',
                        'description'=>'This is the day set for the search start.',
                ),
                'startDate.hour' => array(
                        'type'=>'text',
                        'description'=>'This is the hour set for the search start.',
                        'value'=>'00'
                ),
                'startDate.minute' => array(
                        'type'=>'text',
                        'description'=>'This is the minute set for the search start.',
                ),
                'startDate.second' => array(
                        'type'=>'text',
                        'description'=>'This is the second set for the search start.',
                ),
                'endDate.year' => array(
                        'type'=>'text',
                        'description'=>'This is the year set for the search end.',
                ),
                'endDate.month' => array(
                        'type'=>'text',
                        'description'=>'This is the month set for the search end.',
                ),
                'endDate.day' => array(
                        'type'=>'text',
                        'description'=>'This is the day set for the search end.',
                ),
                'endDate.hour' => array(
                        'type'=>'text',
                        'description'=>'This is the hour set for the search end.',
                ),
                'endDate.minute' => array(
                        'type'=>'text',
                        'description'=>'This is the minute set for the search end.',
                ),
                'endDate.second' => array(
                        'type'=>'text',
                        'description'=>'This is the second set for the search end.',
                ),
                'autoSend'  => array(
                        'type'=>'select',
                        'default'=>array('Y'=>'Y'),
                        'description'=>'',
                ),
            )
        );
    }
}
?>