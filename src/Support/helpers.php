<?php

if(! function_exists('url_query')) {

    /**
     * @param array $data
     * @param string $url
     *
     * @return string
     */
    function url_query($data = [], $url = null)
    {
        $url = $url ?? request()->url();

        $query = http_build_query(array_merge(request()->query(), $data));

        return $url . (empty($query) ?: '?' . $query);
    }
}