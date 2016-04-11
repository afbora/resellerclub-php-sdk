<?php

namespace afbora\ResellerClub\APIs;
use \afbora\ResellerClub\Helper;

class Customers
{
    protected $api = 'customers';

    /**
     * Changes the password for the specified Customer.
     */
    public function change_password($customer_id, $new_password)
    {
        return $this->post('change-password', ['customer-id' => $customer_id, 'new-passwd' => $new_password]);
    }
    
    /**
     * Gets the Customer details for the specified Customer Username.
     */
    public function details($username)
    {
        return $this->get('details', ['username' => $username]);
    }
    
    /**
     * Gets the Customer details for the specified Customer Id.
     */
    public function details_by_id($customer_id)
    {
        return $this->get('details-by-id', ['customer-id' => $customer_id]);
    }
    
    /**
     * Modifies the Account details of the specified Customer.
     */
    public function modify(
        $customer_id,
        $username,
        $name,
        $company,
        $address,
        $city,
        $state,
        $country,
        $zipcode,
        $phone_cc,
        $phone,
        $lang,
    ) {
        return $this->post('modify', [
            'customer-id'        => $customer_id,
            'username'            => $username,
            'name'                => $name,
            'company'            => $company,
            'address-line-1'    => $address,
            'city'                => $city,
            'state'                => $state,
            'country'            => $country,
            'zipcode'            => $zipcode,
            'phone-cc'            => $phone_cc,
            'phone'                => $phone,
            'lang-pref'            => $lang

        ]));
    }
    
    /**
     * Creates a Customer Account using the details provided.
     */
    public function signup(
        $username,
        $passwd,
        $name,
        $company,
        $address,
        $city,
        $state,
        $country,
        $zipcode,
        $phone_cc,
        $phone,
        $lang,
    ) {
        return $this->post('signup', [
            'username'            => $username,
            'passwd'            => $passwd,
            'name'                => $name,
            'company'            => $company,
            'address-line-1'    => $address,
            'city'                => $city,
            'state'                => $state,
            'country'            => $country,
            'zipcode'            => $zipcode,
            'phone-cc'            => $phone_cc,
            'phone'                => $phone,
            'lang-pref'            => $lang

        ]));
    }
    
    /**
     * Generates a temporary password for the specified Customer. The generated password is valid only for 3 days.
     */
    public function temp_password($customer_id)
    {
        return $this->get('temp-password', ['customer-id' => $customer_id]);
    }
}
