<?php

namespace App\Tests\Twig;

use PHPUnit\Framework\TestCase;
use App\Twig\AppExtension;

class SluggerTest extends TestCase
{
    /**
     * @dataProvider getSlugs
     */
    public function testSlugify(string $string, string $slug)
    {
        $slugger = new AppExtension();
        $this->assertSame($slug,$slugger->slugify($string));
    }

    public function getSlugs()
    {

            yield ['Lorem Ipsum', 'loremipsum'];
            yield [' Lorem Ipsum', 'loremipsum'];
            yield ['lorem IPsum', 'loremipsum'];
    }
}
