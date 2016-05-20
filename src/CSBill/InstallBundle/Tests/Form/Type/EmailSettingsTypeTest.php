<?php

/*
 * This file is part of CSBill project.
 *
 * (c) 2013-2016 Pierre du Plessis <info@customscripts.co.za>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace CSBill\InstallBundle\Tests\Form\Type;

use CSBill\CoreBundle\Tests\FormTestCase;
use CSBill\InstallBundle\Form\Type\EmailSettingsType;

class EmailSettingsTypeTest extends FormTestCase
{
    private $transports = [
        'mail' => 'PHP Mail',
        'sendmail' => 'Sendmail',
        'smtp' => 'SMTP',
        'gmail' => 'Gmail',
    ];

    /**
     * @dataProvider formData
     *
     * @param array $formData
     * @param array $assert
     */
    public function testMailSettings(array $formData, array $assert)
    {
        $type = new EmailSettingsType();
        $form = $this->factory->create($type, null, ['transports' => $this->transports]);

        // submit the data to the form directly
        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());
        $this->assertEquals($assert, $form->getData());

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }

    /**
     * @return array
     */
    public function formData()
    {
        return [
            [
                [
                    'transport' => 'mail',
                    'host' => 'localhost',
                    'port' => 1234,
                    'encryption' => 'ssl',
                    'user' => 'root',
                    'password' => 'password',
                ],
                [
                    'transport' => 'mail',
                    'host' => null,
                    'port' => null,
                    'encryption' => null,
                    'user' => null,
                    'password' => null,
                ],
            ],
            [
                [
                    'transport' => 'sendmail',
                    'host' => 'localhost',
                    'port' => 1234,
                    'encryption' => 'ssl',
                    'user' => 'root',
                    'password' => 'password',
                ],
                [
                    'transport' => 'sendmail',
                    'host' => null,
                    'port' => null,
                    'encryption' => null,
                    'user' => null,
                    'password' => null,
                ],
            ],
            [
                [
                    'transport' => 'smtp',
                    'host' => 'localhost',
                    'port' => 1234,
                    'encryption' => 'ssl',
                    'user' => 'root',
                    'password' => 'password',
                ],
                [
                    'transport' => 'smtp',
                    'host' => 'localhost',
                    'port' => 1234,
                    'encryption' => 'ssl',
                    'user' => 'root',
                    'password' => 'password',
                ],
            ],
            [
                [
                    'transport' => 'gmail',
                    'host' => 'localhost',
                    'port' => 1234,
                    'encryption' => 'ssl',
                    'user' => 'root',
                    'password' => 'password',
                ],
                [
                    'transport' => 'gmail',
                    'host' => null,
                    'port' => null,
                    'encryption' => null,
                    'user' => 'root',
                    'password' => 'password',
                ],
            ],
        ];
    }
}
