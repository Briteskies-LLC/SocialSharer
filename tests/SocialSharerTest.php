<?php
use Briteskies\Social\SocialSharer;

class SocialSharerTest extends PHPUnit_Framework_TestCase
{
    const TEST_IMG = "70_rose_peach_89153628.jpg";
    const TEST_URL = 'a-url';

    public function testCanGenerateGooglePlusLink()
    {
        $link = SocialSharer::generateGooglePlusLink(static::TEST_URL);
        $this->assertEquals($link,'https://plus.google.com/share?url=' . static::TEST_URL);

        //This function requires a URL be passed in
        $link = SocialSharer::generateGooglePlusLink('');
        $this->assertNotEquals($link,'https://plus.google.com/share?url=' . static::TEST_URL);
    }

    public function testCanGenerateTwitterLink()
    {
        $link = SocialSharer::generateTwitterLink('');
        $this->assertTrue(is_string($link));
        $this->assertEquals($link,'https://twitter.com/intent/tweet?text=');

        $link = SocialSharer::generateTwitterLink('Tweet', static::TEST_URL, ['a', 'b'], 'nobrowncow', ['nobrowncow', 'navarr'], '762754755970170880');
        $this->assertTrue(is_string($link));
        $this->assertEquals($link, 'https://twitter.com/intent/tweet?text=Tweet&url='.static::TEST_URL.'&hashtags=a%2Cb&via=nobrowncow&related=nobrowncow%2Cnavarr&in-reply-to=762754755970170880');

        $link = SocialSharer::generateTwitterLink('Tweet', static::TEST_URL, ['a'], 'nobrowncow', ['nobrowncow'], '762754755970170880');
        $this->assertTrue(is_string($link));
        $this->assertEquals($link, 'https://twitter.com/intent/tweet?text=Tweet&url='.static::TEST_URL.'&hashtags=a&via=nobrowncow&related=nobrowncow&in-reply-to=762754755970170880');
    }

    public function testCanGenerateFacebookLink()
    {
        $link = SocialSharer::generateFacebookLink(static::TEST_URL);
        $this->assertTrue(is_string($link));
        $this->assertEquals($link,'https://www.facebook.com/sharer.php?s=100&p%5Burl%5D=' . static::TEST_URL);

        $link = SocialSharer::generateFacebookLink(static::TEST_URL, static::TEST_IMG);
        $this->assertTrue(is_string($link));
        $this->assertEquals($link, 'https://www.facebook.com/sharer.php?s=100&p%5Burl%5D='. static::TEST_URL.'&p%5Bimages%5D%5B0%5D='.static::TEST_IMG);

        $link = SocialSharer::generateFacebookLink(static::TEST_URL, static::TEST_IMG, 'Title');
        $this->assertTrue(is_string($link));
        $this->assertEquals($link, 'https://www.facebook.com/sharer.php?s=100&p%5Burl%5D='. static::TEST_URL.'&p%5Bimages%5D%5B0%5D='.static::TEST_IMG.'&p%5Btitle%5D=Title');

        $link = SocialSharer::generateFacebookLink(static::TEST_URL, null, 'Title');
        $this->assertTrue(is_string($link));
        $this->assertEquals($link, 'https://www.facebook.com/sharer.php?s=100&p%5Burl%5D='. static::TEST_URL.'&p%5Btitle%5D=Title');

        $link = SocialSharer::generateFacebookLink(static::TEST_URL, static::TEST_IMG, 'Title', 'Summary');
        $this->assertTrue(is_string($link));
        $this->assertEquals($link, 'https://www.facebook.com/sharer.php?s=100&p%5Burl%5D='. static::TEST_URL.'&p%5Bimages%5D%5B0%5D='.static::TEST_IMG.'&p%5Btitle%5D=Title&p%5Bsummary%5D=Summary');
    }

    public function testCanGeneratePinterestLink()
    {
        $link = SocialSharer::generatePinterestLink(static::TEST_IMG, static::TEST_URL);
        $this->assertTrue(is_string($link));
        $this->assertEquals($link, 'https://pinterest.com/pin/create/button/?media='.static::TEST_IMG."&url=".static::TEST_URL);

        $link = SocialSharer::generatePinterestLink(static::TEST_IMG, static::TEST_URL, 'Description');
        $this->assertTrue(is_string($link));
        $this->assertEquals($link, 'https://pinterest.com/pin/create/button/?media='.static::TEST_IMG.'&url='.static::TEST_URL.'&description=Description');

        //This function requires a URL be passed in
        $link = SocialSharer::generatePinterestLink('', '');
        $this->assertTrue(is_string($link));
        $this->assertNotEquals($link, 'https://pinterest.com/pin/create/button/?media='.static::TEST_IMG."&url=".static::TEST_URL);
    }
}
