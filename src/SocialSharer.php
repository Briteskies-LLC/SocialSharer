<?php

namespace Briteskies\Social;

class SocialSharer {
    private $product;

    const SHARE_VIA_SETTING = '__SHARE_VIA_SETTING__';

    public function getProduct()
    {
        if (!isset( $this->product )) {
            $this->product = Mage::registry('current_product');
        }

        return $this->product;
    }

    /**
     * @param string|null $text Text content of post
     * @param string|null $url Full URL to link to
     * @param array $hashtags Hashtags (without the # character)
     * @param string $via Appends "via @{$via}"
     * @param array $relatedAccounts Related accounts to suggest the user follow
     * @param string|null $inReplyTo ID of tweet this should be a reply to
     * @param string $querySeparator & by default.  May be set to &amp; when going to be output in HTML
     *
     * @return string URL to target sharer
     */
    public function generateTwitterLink(
        $text = null,
        $url = null,
        array $hashtags = array(),
        $via = null,
        array $relatedAccounts = array(),
        $inReplyTo = null,
        $querySeparator = '&'
    ) {
        $intentUrl = 'https://twitter.com/intent/tweet';

        $params = array();
        if (!is_null($text)) {
            $params['text'] = $text;
        }
        if (!is_null($url)) {
            $params['url'] = $url;
        }
        if (!empty( $hashtags )) {
            $params['hashtags'] = implode(',', $hashtags);
        }
        if (!is_null($via)) {
            $params['via'] = $via;
        }
        if (!empty( $relatedAccounts )) {
            $params['related'] = implode(',', $relatedAccounts);
        }
        if (!is_null($inReplyTo)) {
            $params['in-reply-to'] = $inReplyTo;
        }

        return $intentUrl . '?' . http_build_query($params, null, $querySeparator);
    }

    /**
     * @param string $url
     * @param string|null $imageUrl
     * @param string|null $title
     * @param string|null $summary
     * @param string $querySeparator & by default.  May be set to &amp; when going to be output in HTML
     *
     * @return string
     */
    public function generateFacebookLink(
        $url,
        $imageUrl = null,
        $title = null,
        $summary = null,
        $querySeparator = '&'
    ) {
        $linkPrefix = 'https://www.facebook.com/sharer.php';

        $params           = array( 's' => 100 );
        $params['p[url]'] = $url;

        if (!is_null($imageUrl)) {
            $params['p[images][0]'] = $imageUrl;
        }
        if (!is_null($title)) {
            $params['p[title]'] = $title;
        }
        if (!is_null($summary)) {
            $params['p[summary]'] = $summary;
        }

        return $linkPrefix . '?' . http_build_query($params, null, $querySeparator);
    }

    /**
     * @param $image
     * @param $url
     * @param string|null $description
     * @param string $querySeparator & by default.  May be set to &amp; when going to be output in HTML
     *
     * @return string
     */
    public function generatePinterestLink(
        $image,
        $url,
        $description = null,
        $querySeparator = '&'
    ) {
        $linkPrefix = 'https://pinterest.com/pin/create/button/';

        $params = array(
            'media' => $image,
            'url'   => $url,
        );

        if (!is_null($description)) {
            $params['description'] = $description;
        }

        return $linkPrefix . '?' . http_build_query($params, null, $querySeparator);
    }

    /**
     * @param $url
     * @param string $querySeparator & by default.  May be set to &amp; when going to be output in HTML
     *
     * @return string
     */
    public function generateGooglePlusLink($url, $querySeparator = '&')
    {
        $linkPrefix = 'https://plus.google.com/share';

        $params = array(
            'url' => $url
        );

        return $linkPrefix . '?' . http_build_query($params, null, $querySeparator);
    }
}

?>
