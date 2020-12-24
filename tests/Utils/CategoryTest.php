<?php

namespace App\Test\Utils;

use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Twig\AppExtension;

class CategoryTest extends KernelTestCase
{
//    public function testSomething()
//    {
//
//    }
//    protected $mockedCategoryTreeFrontPage;
//    protected $mockedCategoryTreeAdminList;
//    protected $mockedCategoryTreeAdminOptionList;
//
//    protected function setUp()
//    {
//        $kernel = self::bootKernel();
//        $urlgenerator = $kernel->getContainer()->get('router');
//        $tested_classes = [
//            'CategoryTreeAdminList',
//            'CategoryTreeAdminOptionList',
//            'CategoryTreeFrontPage'
//        ];
//
//        foreach ($tested_classes as $class) {
//            $name = 'mocked' . $class;
//            $this->$name = $this->getMockBuilder('App\Utils\\'.$class)
//                ->disableOriginalConstructor()->setMethods()->getMock();
//            $this->$name->urlGenerator = $urlgenerator;
//        }
//
//
//
//    }
//
//    /**
//     * @dataProvider dataForCategoryTreeFrontPage
//     */
//    public function testCategoryTreeFrontPage($string, $array, $id)
//    {
//        $this->mockedCategoryTreeFrontPage->categoriesArrayFromDb = $array;
//        $this->mockedCategoryTreeFrontPage->slugger = new AppExtension;
//        $main_parent_id = $this->mockedCategoryTreeFrontPage->getMainParent($id)['id'];
//        $array = $this->mockedCategoryTreeFrontPage->buildTree($main_parent_id);
//        $this->assertSame($string, $this->mockedCategoryTreeFrontPage->getCategoryList($array));
//
//    }
//
//    /**
//    * @dataProvider dataForCategoryTreeAdminOptionList
//     */
//    public function testCategoryTreeAdminOptionList($arrayCompare, $arrayFromDb)
//    {
//        $this->mockedCategoryTreeAdminOptionList->categoriesArrayFromDb = $arrayFromDb;
//        $arrayFromDb = $this->mockedCategoryTreeAdminOptionList->buildTree();
//        $this->assertSame($arrayCompare, $this->mockedCategoryTreeAdminOptionList->getCategoryList($arrayFromDb));
//    }
//
//    public function dataForCategoryTreeFrontPage()
//    {
//        yield ['<ul><li></li></ul>'];
//    }
//
//    public function dataForCategoryTreeAdminOptionList()
//    {
//        yield [
//        [
//          ['name'=>'Electronics','id'=>1],
//          ['name'=>'--Computers','id'=>6],
//          ['name'=>'----Laptops','id'=>8],
//          ['name'=>'------HP','id'=>14]
//        ],
//            [
//                ['name'=>'Electronics','id'=>1, 'parent_id'=>null],
//                ['name'=>'Computers','id'=>6, 'parent_id'=>1],
//                ['name'=>'Laptops','id'=>8, 'parent_id'=>6],
//                ['name'=>'HP','id'=>14, 'parent_id'=>8]
//            ]
//        ];
//    }
}
