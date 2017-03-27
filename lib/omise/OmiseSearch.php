<?php

require_once dirname(__FILE__).'/res/OmiseApiResource.php';

class OmiseSearch extends OmiseApiResource
{
    const ENDPOINT = 'search';

    /**
     * Retrieves an resource from search.
     *
     * @param  string $querystring
     * @param  string $publickey
     * @param  string $secretkey
     *
     * @return OmiseSearch
     */
    public static function retrieve($scope, $query= '', $filter = array(), $page = 1, $order = 'chronological', $publickey = null, $secretkey = null)
    {
        return parent::g_retrieve(get_class(), self::getUrl($scope, $query, $filter, $page, $order), $publickey, $secretkey);
    }

    /**
     * Generate request url.
     *
     * @param  string $querystring
     *
     * @return string
     */
    private static function getUrl($scope, $query, $filter, $page, $order)
    {
        $querybuild = array('scope' => $scope);

        if (strlen($query) > 0) {
            $querybuild['query'] = $query;
        }

        foreach ($filter as $key => $value) {
            if (is_bool($value)) {
                $value = $value ? 'true' : 'false';
            }
            $querybuild['filters['.$key.']'] = $value;
        }

        if ($page != 1) {
            $querybuild['page'] = $page;
        }

        if ($order != 'chronological') {
            $querybuild['chronological'] = $order;
        }

        $querystring = http_build_query($querybuild);

        return OMISE_API_URL.self::ENDPOINT.'/?'.$querystring;
    }
}
