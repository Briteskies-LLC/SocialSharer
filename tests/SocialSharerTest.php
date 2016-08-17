<?php
use Briteskies\Social\SocialSharer;
class SocialSharerTest extends PHPUnit_Framework_TestCase
{
    const Test_IMG = "70_rose_peach_89153628.jpg";
    const Test_URL = 'a-url';

    public function testCanGenerateGooglePlusLink()
    {
        $link = SocialSharer::generateGooglePlusLink(static::Test_URL);
        $this->assertEquals($link,'https://plus.google.com/share?url=' . static::Test_URL);

        //This function requires a URL be passed in
        $link = SocialSharer::generateGooglePlusLink('');
        $this->assertNotEquals($link,'https://plus.google.com/share?url=' . static::Test_URL);
    }
    public function testCanGenerateTwitterLink()
    {
        $link = SocialSharer::generateTwitterLink('');
        $this->assertEquals($link,'https://twitter.com/intent/tweet?text=');
    }
    public function testCanGenerateFacebookLink()
    {
        $link = SocialSharer::generateFacebookLink(static::Test_URL);
        $this->assertEquals($link,'https://www.facebook.com/sharer.php?s=100&p%5Burl%5D=' . static::Test_URL);
    }
    public function testCanGeneratePinterestLink()
    {
        $link = SocialSharer::generatePinterestLink(static::Test_IMG, static::Test_URL);

        $this->assertEquals($link, 'https://pinterest.com/pin/create/button/?media='.static::Test_IMG."&url=".static::Test_URL);


        //This function requires a URL be passed in
        $link = SocialSharer::generatePinterestLink('', '');
        $this->assertNotEquals($link, 'https://pinterest.com/pin/create/button/?media='.static::Test_IMG."&url=".static::Test_URL);
    }
}
