<?php
use JClaveau\VisibilityViolator\VisibilityViolator;

class VisibilityViolatorTest extends PHPUnit_Framework_TestCase
{
    public static function setUpBeforeClass()
    {
        //
    }

    /**
     * Test the check of the enabling of a social network support
     * /
    public function test_isNetworkEnabled()
    {
        $result = SocialVideo::isNetworkEnabled( SocialVideo::YOUTUBE );
        $this->assertTrue($result);
    }

    /**
     * Set of arguments for test_getVimeoId().
     *
     * @return array The parameters
     * /
    public function test_getVimeoId_dataProvider()
    {
        $urls = [
            'https://vimeo.com/87973054',
            'http://vimeo.com/87973054',
            'http://vimeo.com/87973054',
            'http://player.vimeo.com/video/87973054?title=0&amp;byline=0&amp;portrait=0',
            'http://player.vimeo.com/video/87973054',
            'http://player.vimeo.com/video/87973054',
            'http://player.vimeo.com/video/87973054?title=0&amp;byline=0&amp;portrait=0',
            'http://vimeo.com/channels/vimeogirls/87973054',
            'http://vimeo.com/channels/vimeogirls/87973054',
            'http://vimeo.com/channels/staffpicks/87973054',
            'http://vimeo.com/87973054',
            'http://vimeo.com/channels/vimeogirls/87973054',
        ];

        $test_parameters = [];
        foreach ($urls as $url) {
            $test_parameters[] = [
                $url
            ];
        }

        return $test_parameters;
    }

    /**
     * Test the extraction of ids from Vimeo urls.
     *
     * @param string An example Vimeo URL
     *
     * @dataProvider test_getVimeoId_dataProvider
     * /
    public function test_getVimeoId($url)
    {
        $id = SocialVideo::getVimeoId($url);
        $this->assertEquals('87973054', $id);
    }

    /**/
}
