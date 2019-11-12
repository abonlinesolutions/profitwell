<?php

/**
 * This file contains the a ProfitWell API class definition
 *
 * @package    ProfitWell API class
 * @subpackage Common
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Matthew Raymer <matthew.raymer@anomalistdesign.com>
 *
 *  example:  $pw = new ProfitWell("8537cd5a770c242b57b1833cceb86bf4");
 *
 */

namespace abonlinesolutions\profitwell_php_api;

/**
 * Contains all we need to sync with ProfitWell
 * Class API
 * @package abonlinesolutions\profitwell_php_api
 */

class API {

    private $_api_key = "";
    private $_base_url = "https://api.profitwell.com/v2/";
    private $_command = "";
    private $_verb = "POST";
    private $_request = "";
    private $_response = "";
    private $_isDelete = false;
    private $_error = false;
    private $_message = "";
    private $_last_request = "";

    private $_user_id = "";
    private $_subscription_id = "";
    private $_user_alias = "";
    private $_subscription_alias = "";
    private $_email = "";
    private $_plan_id = "";
    private $_plan_interval = "";
    private $_plan_currency = "";
    private $_status = "";
    private $_value = "";
    private $_effective_date = "";

    /**
     * API constructor.
     * @param string $key
     */
    public function __construct( $key = '' ) {
        $this->_api_key = $key;
    }

    /*
     *  Property Getters and Setters
     */

    public function GetLastRequest() {
        return $this->_last_request;
    }

    /**
     * Retrieve the data from the response from ProfitWell
     *
     * @return string return from request to ProfitWell
     */
    public function GetResponse() {
        return $this->_response;
    }

    /**
     * Flag if there is an error
     *
     * @return boolean  there an error
     */
    public function HadError() {
        return $this->_error;
    }

    /**
     * Error message
     *
     * @return string description of the error
     */
    public function Error() {
        return $this->_message;
    }

    /**
     * Set the ProfitWell $api_key
     *
     * @param string|ProfitWell $api_key
     */
    public function SetApiKey( $api_key ) {
        $this->_api_key = $api_key;
    }
    /**
     * Set the ProfitWell user_id
     *
     * @param string|ProfitWell user_id
     */
    public function SetUserId( $id ) {
        $this->_user_id = $id;
    }

    /**
     * Retrieve the ProfitWell user_id
     *
     * @return string|ProfitWell user_id
     */
    public function GetUserId() {
        return $this->_user_id;
    }
    /**
     * Set the ProfitWell user_alias
     *
     * @param string|ProfitWell user_alias
     */
    public function SetUserAlias( $alias ) {
        $this->_user_alias = $alias;
    }

    /**
     * Retrieve the ProfitWell user_alias
     *
     * @return string|ProfitWell user_alias
     */
    public function GetUserAlias() {
        return $this->_user_alias;
    }

    /**
     * Set the ProfitWell subscription_id
     *
     * @param string|ProfitWell subscription_id
     */
    public function SetSubscriptionId( $id ) {
        $this->_subscription_id = $id;
    }

    /**
     * Retrieve the ProfitWell subscription_id
     *
     * @return string|ProfitWell subscription_id
     */
    public function GetSubscriptionId() {
        return $this->_subscription_id;
    }
    /**
     * Set the ProfitWell subscription_alias
     *
     * @param string|ProfitWell subscription_alias
     */
    public function SetSubscriptionAlias( $alias ) {
        $this->_subscription_alias = $alias;
    }

    /**
     * Retrieve the ProfitWell subscription_alias
     *
     * @return string|ProfitWell subscription_alias
     */
    public function GetSubscriptionAlias() {
        return $this->_subscription_alias;
    }

    /**
     * Set the ProfitWell email address
     * @param string|email address
     */
    public function SetEmail( $email ) {
        $this->_email = $email;
    }

    /**
     * Retrieve the ProfitWell email address
     *
     * @return string|ProfitWell email address
     */
    public function GetEmail() {
        return $this->_email;
    }

    /**
     * Set the ProfitWell plan id
     * @param string|ProfitWell   plan id
     */
    public function SetPlanId($name ) {
        $this->_plan_id = $name;
    }

    /**
     * Retrieve the ProfitWell plan id
     *
     * @return string|ProfitWell plan id
     */
    public function GetPlanId() {
        return $this->_plan_id;
    }

    /**
     * Retrieve the ProfitWell plan interval
     *
     * @param string|ProfitWell plan interval
     */
    public function SetPlanInterval( $plan_interval ) {
        $this->_plan_interval = $plan_interval;
    }

    /**
     * Retrieve the ProfitWell plan interval
     *
     * @return string|ProfitWell plan interval
     */
    public function GetPlanInterval() {
        return $this->_plan_interval;
    }

    /**
     * Retrieve the ProfitWell value
     *
     * @param integer|ProfitWell value (value in cents)
     */
    public function SetValue( $value ) {
        $this->_value = round( floatval($value), 2 );
    }

    /**
     * Retrieve the ProfitWell value
     *
     * @return string|ProfitWell value
     */
    public function GetValue() {
        return $this->_value;
    }

    /**
     * Set the ProfitWell Currency
     *
     * @param string|ProfitWell Currency
     */
    public function SetPlanCurrency( $currency ) {
        $this->_plan_currency = $currency;
    }

    /**
     * Get the ProfitWell Currency
     *
     * @return string|ProfitWell Currency
     */
    public function GetPlanCurrency() {
        return $this->_plan_currency;
    }

    /**
     * Set the ProfitWell status
     *
     * @param string|ProfitWell status
     * for creation : "active" or "trialing"
     * other value : "trialing", "churned_voluntary" and "churned_delinquent"
     */
    public function SetStatus( $status ) {
        $this->_status = $status;
    }

    /**
     * Get the ProfitWell status
     *
     * @return string|ProfitWell status
     */
    public function GetStatus() {
        return $this->_status;
    }

    /**
     * Set the ProfitWell EffectiveDate
     *
     * @param string|ProfitWell EffectiveDate
     * timestamp format
     *
     */
    public function SetEffectiveDate( $effective_date ) {
        $this->_effective_date = $effective_date;
    }

    /**
     * Get the ProfitWell EffectiveDate
     *
     * @return string|ProfitWell EffectiveDate
     */
    public function GetEffectiveDate() {
        return $this->_effective_date;
    }

    /*
     *  Public Methods
     */

    /**
     * Add a user subscription to ProfitWell
     *
     */
    public function Add() {
        $this->_verb = "POST";
        $this->_command = "subscriptions/";
        if ($this->isValid()) {
            $this->request();
            if ( $this->_response == "" ) {
                $this->_error = true;
                $this->_message = "Expected return data from server for Add event.";
            } else {
                $ro = json_decode( $this->_response );
                $this->_user_id = $ro->user_id;
                $this->_subscription_id = $ro->subscription_id;
            }
        }
    }

    public function Output() {
        echo "user_id: " . $this->_user_id . "\n";
        echo "user_alias: " . $this->_user_alias . "\n";
        echo "subscription_id: " . $this->_subscription_id . "\n";
        echo "subscription_alias: " . $this->_subscription_alias . "\n";
        echo "email: " . $this->_email . "\n";
        echo "plan_id: " . $this->_plan_id . "\n";
        echo "plan_interval: " . $this->_plan_interval . "\n";
        echo "value: " . $this->_value . "\n";
        echo "plan_currency: " . $this->_plan_currency . "\n";
        echo "status: " . $this->_status . "\n";
        echo "effective_date: " . $this->_effective_date . "\n";
    }

    public function toString() {
        $result  = "user_id: " . $this->_user_id . "\n";
        $result .= "user_alias: " . $this->_user_alias . "\n";
        $result .= "subscription_id: " . $this->_subscription_id . "\n";
        $result .= "subscription_alias: " . $this->_subscription_alias . "\n";
        $result .="email: " . $this->_email . "\n";
        $result .="plan_id: " . $this->_plan_id . "\n";
        $result .="plan_interval: " . $this->_plan_interval . "\n";
        $result .="value: " . $this->_value . "\n";
        $result .="plan_currency: " . $this->_plan_currency . "\n";
        $result .="status: " . $this->_status . "\n";
        $result .="effective_date: " . $this->_effective_date . "\n";
        return $result;
    }

    public function toHtml() {
        $result  = "<ul>";
        $result  .= "<li>user_id: " . $this->_user_id . "</li>";
        $result .= "<li>subscription_id: " . $this->_subscription_id . "</li>";
        $result .= "<li>email: " . $this->_email . "</li>";
        $result .= "<li>plan_id: " . $this->_plan_id . "</li>";
        $result .= "<li>plan_interval: " . $this->_plan_interval . "</li>";
        $result .= "<li>value: " . $this->_value . "</li>";
        $result .= "<li>plan_currency: " . $this->_plan_currency . "</li>";
        $result .= "<li>status: " . $this->_status . "</li>";
        $result .= "effective_date: " . $this->_effective_date . "</li>";
        $result .= "</ul>";
        return $result;
    }

    public function toJSON() {
        $result = array(
            "user_id" => $this->_user_id,
            "subscription_id" => $this->_subscription_id,
            "email" => $this->_email,
            "plan_id" => $this->_plan_id,
            "value" => $this->_value,
            "plan_currency" => $this->_plan_currency,
            "status" => $this->_status,
            "effective_date" => $this->_effective_date);
        return json_encode( $result );
    }

    /**
     * Update a user subscription to ProfitWell
     * @param string $subscription_id
     */
    public function Update( $subscription_id ) {
        $this->_verb="PUT";
        // $this->_effective_date = date("Y-m-d\TH:i");
        if ( $subscription_id == "" ) {
            $this->_error = true;
            $this->_message = "Update requires a ProfitWell user_id to be populated";
        } else {
            $this->_subscription_id = $subscription_id;
            $this->_command = "subscriptions/" . $subscription_id ."/";
            $this->request();
        }
    }

    /**
     * Churn a subscription to ProfitWell
     *
     * Churning is ending a subscription
     * @param string|ProfitWell subscription_id
     */
    public function Churn( $subscription_id ) {
        $this->_verb = "DELETE";
        $this->_command = "subscriptions/" . $subscription_id . "/?effective_date=".$this->_effective_date."&churn_type=voluntary";
        $this->request();return $this->_response;
    }

    /**
     * UnChurn Update the subscription_id to ProfitWell
     *
     * Reinstate the Subscriptions to subscription_id
     * @param string|ProfitWell subscription_id
     */
    public function UnChurn( $subscription_id ) {
        $this->_verb = "PUT";
        $this->_command = "unchurn/" . $subscription_id . "/";
        $this->request();
    }

    /**
     * Deleting all the data of the user from ProfitWell
     *
     * @param string|ProfitWell user_id
     */
    public function Delete( $user_id ) {
        $this->_verb="DELETE";
        $this->_command = "transactions/user/" . $user_id . "/";
        $this->request();
    }

    /**
     * Listing all the data of all the  users to  ProfitWell
     *
     * @return string|array of ProfitWell user subscriptions
     */
    public function ListAll() {
        $this->_verb = "GET";
        $this->_command = "metrics/plans/";
        $this->request();
        return $this->_response;
    }

    /**
     * Listing of a data  for the  user for a specific user_id to ProfitWell
     *
     * @param string|ProfitWell user_id
     * @return string|array of data about a single ProfitWell subscription
     */
    public function ListByUserId( $user_id ) {
        $this->_verb = "GET";
        $this->_command = "transactions/user/" . $user_id . "/";
        $this->request();
        return $this->_response;
    }


    /**
     * Listing of a data for Monthly Metrics to ProfitWell
     *
     * @param string|ProfitWell $options
     * String | plan_id     Optionally only return the metrics for this plan_id.
     * String  metrics
    An optional, comma-separated list of metrics trends to return (the default is to return all metrics).

     * @return string|array of data about a single ProfitWell subscription
     */
    public function MonthlyMetrics( $options ) {
        $this->_verb = "GET";
        $sOption = '';

        if (isset($options['plan_id'])) {
            $sOption = 'plan_id='.$options['plan_id'];
        }
        if (isset($options['metrics'])) {
            $sOption .= strlen($sOption) > 1 ? '&' : '';
            $sOption .= 'metrics='.$options['metrics'];
        }
        $this->_command = "metrics/monthly/".strlen($sOption) > 1 ? "?".$sOption : '';
        $this->request();
        return $this->_response;
    }


    /**
     * Creating a JSON data pocket request  for Profitwell
     *
     */
    private function MakeRequest() {

        $this->_request = "{";
        if (!empty($this->_user_id)) {
            $this->_request .= "\"user_id\": \"$this->_user_id\",";
        }
        if (!empty($this->_user_alias)) {
            $this->_request .= "\"user_alias\": \"$this->_user_alias\",";
        }

        $this->_request .= "
      \"subscription_alias\": \"$this->_subscription_alias\",
      \"email\": \"$this->_email\",
      \"plan_id\": \"$this->_plan_id\",
      \"plan_interval\": \"$this->_plan_interval\",
      \"value\": $this->_value,
      \"plan_currency\": \"$this->_plan_currency\",
      \"value\": \"$this->_value\",
      \"effective_date\": \"$this->_effective_date\"
      }";

        $this->_last_request = $this->_request;
    }

    private function isValid() {
        $valid = true;
        if ( trim($this->_email) == "" ) $valid = false;
        if ( trim($this->_plan_id) == "") $valid = false;
        if ( trim($this->_plan_interval) == "") $valid = false;
        if ( trim($this->_plan_currency) == "") $valid = false;
        if ( trim($this->_effective_date) == "") $valid = false;
        return $valid;
    }

    /**
     * Send data to ProfitWell and handle the return response data
     *
     */
    private function request() {

        $this->MakeRequest();

        $ch = curl_init();
        $url = $this->_base_url . $this->_command;

        curl_setopt( $ch, CURLOPT_URL, $url );
        if ( $this->_verb == "DELETE" ) curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, "DELETE" );
        if ( $this->_verb == "PUT" ) curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, TRUE );
        curl_setopt( $ch, CURLOPT_HEADER, FALSE );
        if ( $this->_verb == "POST") {
            curl_setopt( $ch, CURLOPT_POST, TRUE );
        }
        if ( $this->_verb == "POST" || $this->_verb == "PUT" ) {
            curl_setopt( $ch, CURLOPT_POSTFIELDS, $this->_request );
        }
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "Authorization: " . $this->_api_key
        ));
        $response = curl_exec( $ch );
        curl_close( $ch );
        $this->_response = $response;

    }
}