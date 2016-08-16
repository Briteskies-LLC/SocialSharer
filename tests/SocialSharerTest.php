<?php
use Briteskies\Social\SocialSharer;
class SocialSharerTest extends PHPUnit_Framework_TestCase
{
    const Test_IMG = "images/70_rose_peach_89153628.jpg";
    const Test_URL = 'a-url';

    public function testCanGenerateGooglePlusLink()
    {
        $socialsharer = new SocialSharer();
        $link = $socialsharer->generateGooglePlusLink(Test_URL);
        $this->assertTrue($link == 'https://plus.google.com/share?url=' . Test_URL);

        //This function requires a URL be passed in
        $link = $socialsharer->generateGooglePlusLink();
        $this->assertFalse($link == 'https://plus.google.com/share?url=' . Test_URL);
    }
    public function testCanGenerateTwitterLink()
    {
        $socialsharer = new SocialSharer();
        $link = $socialsharer->generateTwitterLink('');
        $this->assertTrue($link == 'https://twitter.com/intent/tweet?text=');
    }
    public function testCanGenerateFacebookLink()
    {
        $socialsharer = new SocialSharer();
        $link = $socialsharer->generateFacebookLink(Test_URL);
        $this->assertTrue($link == 'https://www.facebook.com/sharer.php?s=100&p%5Burl%5D=');
    }
    public function testCanGeneratePinterestLink()
    {
        $socialsharer = new SocialSharer();
        $link = $socialsharer->generatePinterestLink(Test_IMG, Test_URL);
        $this->assertTrue($link == 'https://pinterest.com/pin/create/button/?media='.Test_IMG."&url=".Test_URL);


        //This function requires a URL be passed in
        $link = $socialsharer->generateGooglePlusLink();
        $this->assertTrue($link == 'https://pinterest.com/pin/create/button/?media='.Test_IMG."&url=".Test_URL);
    }
}