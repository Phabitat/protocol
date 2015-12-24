<?php

namespace Protocol\Test\Http\Request\Factory;

use Protocol\Http\Constant\MediaType;
use Protocol\Http\Request\Constant\Method;
use Protocol\Http\Request\Factory\SuperglobalsFactory;
use Protocol\Test\AbstractTestCase;

class SuperglobalFactoryTestCase extends AbstractTestCase
{

    /**
     * @covers \Protocol\Http\Request\Factory\SuperglobalsFactory::isJsonAsPost
     * @covers \Protocol\Http\Request\Factory\SuperglobalsFactory::useJsonAsPost
     */
    public function testJsonAsPost()
    {
        $json = [
            'foo' => 'bar',
            'baz' => [
                'a' => 'Letter A',
                'b' => 'Letter B',
                'c' => 'Letter C'
            ]
        ];

        $factory = SuperglobalsFactory::instance()
            ->setInput(json_encode($json))
            ->setPost([])
            ->setServer(['CONTENT_TYPE' => MediaType::JSON, 'REQUEST_METHOD' => Method::POST]);

        // Check with json as post option on.

        $request = $factory->construct();
        $this->assertSame($json, $request->getPostParameters());

        // Check with json as post option off.

        $request = $factory->useJsonAsPost(false)->construct();
        $this->assertSame([], $request->getPostParameters());
    }

    /**
     * @covers \Protocol\Http\Request\Factory\SuperglobalsFactory::normaliseFiles
     */
    public function testNormaliseFiles()
    {
        $factory = new SuperglobalsFactory();
        $method  = $this->getAccessibleMethod($factory, 'normaliseFile');

        $array = [
            'name'     => [
                'foo' => [
                    'bar' => [
                        'baz' => [
                            'a' => 'file1',
                            'b' => 'file2',
                            'c' => 'file3'
                        ]
                    ],
                    'qux' => [
                        'file4',
                        'file5',
                        'file6'
                    ]]],
            'tmp_name' => [
                'foo' => [
                    'bar' => [
                        'baz' => [
                            'a' => 'ZW23M2B8dZIXYYM8N21VouozEn06mnfM',
                            'b' => 'vDL6MJ1U3E1HPXW80wRZG9SA00Uz4N0K',
                            'c' => 'V9W6ZI2SivXh66NSN6g8XLCWzg8t5AD1'
                        ]
                    ],
                    'qux' => [
                        'ACk8nWs95vvp6Q95F8DHtSxWkTlz5fb6',
                        'RLRLIZ8bwqNH9F2krJM4r5Vl2N89k3gV',
                        '2Yp8d14JI101554O12CpqeHKDlRJKVrK'
                    ]]],
            'size'     => [
                'foo' => [
                    'bar' => [
                        'baz' => [
                            'a' => '1024',
                            'b' => '1024',
                            'c' => '1024'
                        ]
                    ],
                    'qux' => [
                        '1024',
                        '1024',
                        '1024'
                    ]]],
            'type'     => [
                'foo' => [
                    'bar' => [
                        'baz' => [
                            'a' => '',
                            'b' => '',
                            'c' => ''
                        ]
                    ],
                    'qux' => [
                        '',
                        '',
                        ''
                    ]]],
            'error'    => [
                'foo' => [
                    'bar' => [
                        'baz' => [
                            'a' => UPLOAD_ERR_OK,
                            'b' => UPLOAD_ERR_OK,
                            'c' => UPLOAD_ERR_OK
                        ]
                    ],
                    'qux' => [
                        UPLOAD_ERR_OK,
                        UPLOAD_ERR_OK,
                        UPLOAD_ERR_OK
                    ]]]
        ];

        $files = $method->invoke($factory, $array['name'], $array['tmp_name'], $array['type'], $array['size'], $array['error']);

        $this->assertTrue(isset($files['foo']['bar']['baz']['a']));
        $this->assertTrue(isset($files['foo']['bar']['baz']['b']));
        $this->assertTrue(isset($files['foo']['bar']['baz']['c']));
        $this->assertTrue(isset($files['foo']['qux'][0]));
        $this->assertTrue(isset($files['foo']['qux'][1]));
        $this->assertTrue(isset($files['foo']['qux'][2]));
    }
}