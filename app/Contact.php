<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Propaganistas\LaravelPhone\PhoneNumber;

class Contact extends Model
{
    protected $table='contacts';

    protected $appends=['isMobilePhone','isLocalPSTNPhone','phoneFormat_RFC','phoneFormat_National','phoneFormat_Local','phoneCarrier'];
    
    public function organisations(){
      //return $this->belongsTo('App\Organisation');
      return $this->morphedByMany('App\Organisation','contactowner');
    }

    public function taxiservices()
    {
      return $this->morphedByMany('App\TaxiService','contactowner');
    }

    /**
     * Set attribute to true if contact is mobile phone
     */
    public function getIsMobilePhoneAttribute(){
      if($this->contact_type == 'phone')
        return PhoneNumber::make($this->contact)->isOfType('mobile');
    }

    /**
     * Set attribute to phone number formatted by RFC3966 ("tel:+7-904-777-06-06")
     */
    public function getPhoneFormatRFCAttribute(){
      if($this->contact_type == 'phone')
        return phone($this->contact,'RU',\libphonenumber\PhoneNumberFormat::RFC3966);
    }

    /**
     * Set attribute to phone number formatted national  ("8 (904) 777-06-06")
     */
    public function getPhoneFormatNationalAttribute(){
      if($this->contact_type == 'phone')
        return phone($this->contact,'RU',\libphonenumber\PhoneNumberFormat::NATIONAL);
    }

    /**
     * Set true if phone is local fixed line number
     */
    public function getIsLocalPSTNPhoneAttribute(){
      if($this->contact_type !== 'phone') return;

      return strpos($this->phoneFormat_National,'8 (844) 42') !== false;
    }

    /**
     * Set attribute to short Uryupinsk fixed line format ("3-75-75")
     */
    public function getPhoneFormatLocalAttribute(){
      if($this->contact_type !== 'phone') return;

      if ($this->isLocalPSTNPhone) {
        return substr($this->phoneFormat_National,strlen($this->phoneFormat_National)-7,7);
      }else{
        return $this->phoneFormat_National;
      }
    }

    /**
     * Set attribute to mobile carrier name ("Beeline")
     */
    public function getPhoneCarrierAttribute(){
      if($this->contact_type !== 'phone') return;

      $carrierMapper = \libphonenumber\PhoneNumberToCarrierMapper::getInstance();
      $carrierName = $carrierMapper->getNameForNumber(PhoneNumber::make($this->contact)->getPhoneNumberInstance(),'EN');

      if($carrierName == '' && $this->isMobilePhone) {
        if(preg_match('/\+798[78]/',$this->contact) === 1){
          return 'MTS';
        }
      }

      return $carrierName;
    }
}
