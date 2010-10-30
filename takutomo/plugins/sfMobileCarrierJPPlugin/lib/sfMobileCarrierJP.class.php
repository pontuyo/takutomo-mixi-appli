<?php
  /**
   * sfMobileCarrierJP class
   */
class sfMobileCarrierJP extends sfBaseMobileCarrierJP
{
    /**
     * isMobileIp()
     *
     * #test isMobileIp1
     * <code>
     * #ok(sfMobileCarrierJP::isMobileIp("210.136.161.1")
     *  ,"210.136.161.1 is in mobile CIDR");
     * #false(sfMobileCarrierJP::isMobileIp("210.251.1.193")
     *  ,"210.251.1.193 is in mobile CIDR");
     * #ok(sfMobileCarrierJP::isMobileIp("210.146.60.240")
     *  ,"210.146.60.240 is in mobile CIDR");
     * #ok(sfMobileCarrierJP::isMobileIp("61.198.249.3")
     *  ,"61.198.249.3 is in mobile CIDR");
     * </code>
     *
     *
     */
    public static function isMobileIp($ip){
        return (sfMobileCarrierJP::isKtaiIp($ip)
                || sfMobileCarrierJP::isAirhphoneIp($ip));
    }
    /**
     * isKtaiIp()
     *
     * #test isKtaiIp1
     * <code>
     * #true(sfMobileCarrierJP::isKtaiIp("210.136.161.1"));
     * #false(sfMobileCarrierJP::isKtaiIp("210.251.1.193")); // 2009-3-10 ezweb 廃止
     * #true(sfMobileCarrierJP::isKtaiIp("219.125.146.2"));  // 
     * #true(sfMobileCarrierJP::isKtaiIp("210.146.60.240"));
     * #false(sfMobileCarrierJP::isKtaiIp("61.198.249.3")); // AirH
     * </code>
     *
     */
    public static function isKtaiIp($ip){
        return (sfMobileCarrierJP::isDocomoIp($ip)
                || sfMobileCarrierJP::isEzwebIp($ip)
                || sfMobileCarrierJP::isThirdforceIp($ip));
    }
    /**
     * isDocomoIp()
     *
     * #test isDocomoIp1
     * <code>
     * #true(sfMobileCarrierJP::isDocomoIp("210.136.161.1"));
     * </code>
     * #test isDocomoIp2
     * <code>
     * #true(sfMobileCarrierJP::isDocomoIp("210.136.161.16"));
     * </code>
     * #test isDocomoIp3
     * <code>
     * #true(sfMobileCarrierJP::isDocomoIp("210.136.161.255"));
     * </code>
     * #test isDocomoIp4
     * <code>
     * #false(sfMobileCarrierJP::isDocomoIp("210.136.162.1"));
     * </code>
     */
    public static function isDocomoIp($ip){
        $i = ip2long($ip);
        $cidrs = sfMobileCarrierJP::getDocomoCidr();
        foreach($cidrs as $cidr){
            if(sfMobileCarrierJP::inCidr($ip,$cidr["ip"]
                                         ,$cidr["subnetmask"])){
                return true;
            }
        }
        return false;
    }
    /**
     * isEzwebIp()
     *
     * #test isEzwebIp1
     * <code>
     * #true(sfMobileCarrierJP::isEzwebIp("219.125.146.2"));
     * </code>
     * #test isEzwebIp2
     * <code>
     * #false(sfMobileCarrierJP::isEzwebIp("210.136.161.255"));
     * </code>
     */
    public static function isEzwebIp($ip){
        $i = ip2long($ip);
        $cidrs = sfMobileCarrierJP::getEzwebCidr();
        foreach($cidrs as $cidr){
            if(sfMobileCarrierJP::inCidr($ip,$cidr["ip"]
                                         ,$cidr["subnetmask"])){
                return true;
            }
        }
        return false;
    }
    /**
     * isThirdforceIp()
     *
     * #test isThirdforceIp1
     * <code>
     * #true(sfMobileCarrierJP::isThirdforceIp("210.146.60.240"));
     * </code>
     * #test isThirdforceIp2
     * <code>
     * #false(sfMobileCarrierJP::isThirdforceIp("211.5.2.128"));
     * #false(sfMobileCarrierJP::isThirdforceIp("210.136.161.255"));
     * </code>
     */
    public static function isThirdforceIp($ip){
        $i = ip2long($ip);
        $cidrs = sfMobileCarrierJP::getThirdforceCidr();
        foreach($cidrs as $cidr){
            if(sfMobileCarrierJP::inCidr($ip,$cidr["ip"]
                                         ,$cidr["subnetmask"])){
                return true;
            }
        }
        return false;
    }
    /**
     * isAirhphone()
     *
     * #test isAirhphone1
     * <code>
     * #true(sfMobileCarrierJP::isAirhphoneIp("61.198.249.3"));
     * </code>
     * #test isAirhphone2
     * <code>
     * #false(sfMobileCarrierJP::isAirhphoneIp("210.146.60.240"));
     * #false(sfMobileCarrierJP::isAirhphoneIp("211.5.2.128"));
     * #false(sfMobileCarrierJP::isAirhphoneIp("210.136.161.255"));
     * </code>
     */
    public static function isAirhphoneIp($ip){
        $i = ip2long($ip);
        $cidrs = sfMobileCarrierJP::getAirhphoneCidr();
        foreach($cidrs as $cidr){
            if(sfMobileCarrierJP::inCidr($ip,$cidr["ip"]
                                         ,$cidr["subnetmask"])){
                return true;
            }
        }
        return false;
    }
    /**
     * inCidr()
     *
     * #test inCidr1
     * <code>
     * #true(sfMobileCarrierJP::inCidr("100.123.123.45","100.123.123.0",24));
     * #true(sfMobileCarrierJP::inCidr("100.123.123.45","100.123.123.0","/24"));
     * </code>
     * #test inCidr2
     * <code>
     * #false(sfMobileCarrierJP::inCidr("100.123.113.45","100.123.123.0","/24"));
     * </code>
     * #test inCidr3
     * <code>
     * #true(sfMobileCarrierJP::inCidr("100.123.113.45","100.123.123.0",16));
     * </code>
     */
    public static function inCidr($ip,$net,$mask){
        if(preg_match("/\/([\d]+)/",$mask,$m)){
            $mask = $m[1];
        }
        $mask = (pow(2,$mask)-1)<<(32-$mask);
        if((ip2long($ip) & $mask) ==  (ip2long($net) & $mask)){
            return true;
        }
        return false;
    }
    /**
     * #test ::isMobileEmailAddress
     * <code>
     * #true(sfMobileCarrierJP::isMobileEmailAddress("hoge@docomo.ne.jp"));
     * #true(sfMobileCarrierJP::isMobileEmailAddress("hoge@ezweb.ne.jp"));
     * #false(sfMobileCarrierJP::isMobileEmailAddress("hoge@gmail.com"));
     * #false(sfMobileCarrierJP::isMobileEmailAddress("hoge@i.softbank.ne.jp"));
     * #true(sfMobileCarrierJP::isMobileEmailAddress("hoge@softbank.ne.jp"));
     * </code>
     */
    public static function isMobileEmailAddress($emailaddr){
      // ドメイン情報を取得
      $domains = sfMobileCarrierJP::getDomains();
      $pattern = "/^[^@\s]+@((?:[-a-z0-9]+\.)+[a-z]{2,})$/i";
      if (preg_match($pattern, $emailaddr, $matches)) { // check EmailAddress
          foreach($domains as $domain) {
            $match_domain = $matches[1];
            if ($match_domain == $domain) { // check mobile domain
              return true; 
            }
          }
      }
      return false;
    }

    /**
     * getDomains()
     *
     * #test getDomains
     * <code>
     * #is(count(sfMobileCarrierJP::getDomains()), 30);
     * </code>
     */
    public static function getDomains() {
      $domains = self::loadYaml("domain-list");
      return $domains['domains'];
    }
}