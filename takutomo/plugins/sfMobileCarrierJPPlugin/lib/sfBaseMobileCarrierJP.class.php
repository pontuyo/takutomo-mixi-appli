<?php
class sfBaseMobileCarrierJP {
    public static function loadYaml($name) {
        $file = SF_ROOT_DIR . "/plugins/sfMobileCarrierJPPlugin/data/" . $name . ".yml";
        $fileCache = new sfFileCache(array('cache_dir' => 
        SF_ROOT_DIR . "/cache/" . SF_APP . "/" . SF_ENVIRONMENT . "/sfMobileCarrierJPPlugin"));
        
        $cache = new sfFunctionCache($fileCache);
        return $cache->call("sfYaml::load", $file);
    }
    /**
     * getDocomoCidr()
     *
     * #test
     * <code>
     * #true(count(sfBaseMobileCarrierJP::getDocomoCidr()) > 0);
     * </code>
     */
    public static function getDocomoCidr() {
        return self::loadYaml("docomo-cidr");
    }
    /**
     * getDocomoPictograminfo()
     *
     * #test
     * <code>
     * #true(count(sfBaseMobileCarrierJP::getDocomoPictograminfo()) > 0);
     * </code>
     */
    public static function getDocomoPictograminfo() {
        return self::loadYaml("docomo-pictograminfo");
    }
    /**
     * getDocomoDisplay()
     *
     * #test
     * <code>
     * #true(count(sfBaseMobileCarrierJP::getDocomoDisplay()) > 0);
     * </code>
     */
    public static function getDocomoDisplay() {
        return self::loadYaml("docomo-display");
    }
    /**
     * getThirdforceUseragent()
     *
     * #test
     * <code>
     * #true(count(sfBaseMobileCarrierJP::getThirdforceUseragent()) > 0);
     * </code>
     */
    public static function getThirdforceUseragent() {
        return self::loadYaml("thirdforce-useragent");
    }
    /**
     * getEzwebDeviceid()
     *
     * #test
     * <code>
     * #true(count(sfBaseMobileCarrierJP::getEzwebDeviceid()) > 0);
     * </code>
     */
    public static function getEzwebDeviceid() {
        return self::loadYaml("ezweb-deviceid");
    }
    /**
     * getDocomoHtmlversion()
     *
     * #test
     * <code>
     * #true(count(sfBaseMobileCarrierJP::getDocomoHtmlversion()) > 0);
     * </code>
     */
    public static function getDocomoHtmlversion() {
        return self::loadYaml("docomo-htmlversion");
    }
    /**
     * getThirdforceCidr()
     *
     * #test
     * <code>
     * #true(count(sfBaseMobileCarrierJP::getThirdforceCidr()) > 0);
     * </code>
     */
    public static function getThirdforceCidr() {
        return self::loadYaml("thirdforce-cidr");
    }
    /**
     * getThirdforcePictograminfo()
     *
     * #test
     * <code>
     * #true(count(sfBaseMobileCarrierJP::getThirdforcePictograminfo()) > 0);
     * </code>
     */
    public static function getThirdforcePictograminfo() {
        return self::loadYaml("thirdforce-pictograminfo");
    }
    /**
     * getEzwebBrew()
     *
     * #test
     * <code>
     * #true(count(sfBaseMobileCarrierJP::getEzwebBrew()) > 0);
     * </code>
     */
    public static function getEzwebBrew() {
        return self::loadYaml("ezweb-brew");
    }
    /**
     * getEzwebModel()
     *
     * #test
     * <code>
     * #true(count(sfBaseMobileCarrierJP::getEzwebModel()) > 0);
     * </code>
     */
    public static function getEzwebModel() {
        return self::loadYaml("ezweb-model");
    }
    /**
     * getDocomoFlash()
     *
     * #test
     * <code>
     * #true(count(sfBaseMobileCarrierJP::getDocomoFlash()) > 0);
     * </code>
     */
    public static function getDocomoFlash() {
        return self::loadYaml("docomo-flash");
    }
    /**
     * getEzwebCidr()
     *
     * #test
     * <code>
     * #true(count(sfBaseMobileCarrierJP::getEzwebCidr()) > 0);
     * </code>
     */
    public static function getEzwebCidr() {
        return self::loadYaml("ezweb-cidr");
    }
    /**
     * getEzwebPictograminfo()
     *
     * #test
     * <code>
     * #true(count(sfBaseMobileCarrierJP::getEzwebPictograminfo()) > 0);
     * </code>
     */
    public static function getEzwebPictograminfo() {
        return self::loadYaml("ezweb-pictograminfo");
    }
    /**
     * getAirhphoneCidr()
     *
     * #test
     * <code>
     * #true(count(sfBaseMobileCarrierJP::getAirhphoneCidr()) > 0);
     * </code>
     */
    public static function getAirhphoneCidr() {
        return self::loadYaml("airhphone-cidr");
    }
    /**
     * getThirdforceHttpheader()
     *
     * #test
     * <code>
     * #true(count(sfBaseMobileCarrierJP::getThirdforceHttpheader()) > 0);
     * </code>
     */
    public static function getThirdforceHttpheader() {
        return self::loadYaml("thirdforce-httpheader");
    }
    /**
     * getDomainList()
     *
     * #test
     * <code>
     * #true(count(sfBaseMobileCarrierJP::getDomainList()) > 0);
     * </code>
     */
    public static function getDomainList() {
        return self::loadYaml("domain-list");
    }
    /**
     * getThirdforceService()
     *
     * #test
     * <code>
     * #true(count(sfBaseMobileCarrierJP::getThirdforceService()) > 0);
     * </code>
     */
    public static function getThirdforceService() {
        return self::loadYaml("thirdforce-service");
    }
    /**
     * getDocomoUseragent()
     *
     * #test
     * <code>
     * #true(count(sfBaseMobileCarrierJP::getDocomoUseragent()) > 0);
     * </code>
     */
    public static function getDocomoUseragent() {
        return self::loadYaml("docomo-useragent");
    }
}
