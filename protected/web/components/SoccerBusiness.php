<?php

    /**
     * Class SoccerBusiness
     *
     * This class to process something about soccer.
     * Ideas: get soccer detail from somewhere, eg: a external page, or in the future, from database, or some webservice....
     *      and set it into cache.
     * Uses: Init some soccer detail (match id, livescore, ....) and follow the detail, get data and set theme into cache.
     *      In some functions, you call the data from cache
     */
class SoccerBusiness{

    const URL_MATCH_DETAIL = 'http://vov.paysv.com/Tran/Partial_MatchDetail?';

    private $content;

    public $matchId;

    public function __construct()
    {


    } //end construct

    /**
     * This function get content from match detail url, and then, set data to $this->content
     * @param int    $isMobile
     * @param string $loaiChiTiet
     * @param string $partnerUrl
     *
     * @return string|bool
     */
    public function loadMatchDetail($isMobile = 0, $loaiChiTiet = '', $partnerUrl = '/')
    {
        $strUrlGetData = self::URL_MATCH_DETAIL.'MaTran='.$this->matchId.'&LoaiChiTiet='.$loaiChiTiet.'&isMobile='.$isMobile.'&PartnerUrl='.$partnerUrl;

        // Tạo mới một CURL
        $ch = curl_init();
        // Cấu hình cho CURL
        curl_setopt($ch, CURLOPT_URL, $strUrlGetData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // Thực thi CURL
        $result = curl_exec($ch);
        // Ngắt CURL, giải phóng
        $cls = curl_close($ch);

        $this->content = $result;

        if ($result) return true; else return false;

    } //end get match detail

    /**
     * @param int $isMobile
     */
    public function setMatchToCache($isMobile = 0)
    {
        if ($isMobile)
        {
            Yii::app()->cache->set('matchDetailMobile_'.$this->matchId, $this->content);
        } else {
            Yii::app()->cache->set('matchDetail_'.$this->matchId, $this->content);
        }
    }//end set match to cache

    public function getMatchFromCache($isMobile = 0)
    {
        if ($isMobile)
        {
            return Yii::app()->cache->get('matchDetailMobile_'.$this->matchId);
        } else {
            return Yii::app()->cache->get('matchDetail_'.$this->matchId);
        }
    } //end get match from catch


    /**
     * Return content of soccer, match detail, livescore, or etc....
     * @return string|bool
     */
    public function getContent()
    {
        if ($this->content) {
            return $this->content;
        } else {
            return false;
        }
    } //end get content

} //end class