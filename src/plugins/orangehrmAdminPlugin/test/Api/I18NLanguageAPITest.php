<?php
/**
 * OrangeHRM is a comprehensive Human Resource Management (HRM) System that captures
 * all the essential functionalities required for any enterprise.
 * Copyright (C) 2006 OrangeHRM Inc., http://www.orangehrm.com
 *
 * OrangeHRM is free software; you can redistribute it and/or modify it under the terms of
 * the GNU General Public License as published by the Free Software Foundation; either
 * version 2 of the License, or (at your option) any later version.
 *
 * OrangeHRM is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
 * without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with this program;
 * if not, write to the Free Software Foundation, Inc., 51 Franklin Street, Fifth Floor,
 * Boston, MA  02110-1301, USA
 */

namespace OrangeHRM\Tests\Admin\Api;

use OrangeHRM\Admin\Api\I18NLanguageAPI;
use OrangeHRM\Framework\Services;
use OrangeHRM\Tests\Util\EndpointIntegrationTestCase;
use OrangeHRM\Tests\Util\Integration\TestCaseParams;

/**
 * @group Admin
 * @group APIv2
 */
class I18NLanguageAPITest extends EndpointIntegrationTestCase
{
    protected function setUp(): void
    {
        $this->markTestSkipped();
    }

    /**
     * @dataProvider dataProviderForTestGetAll
     */
    public function testGetAll(TestCaseParams $testCaseParams): void
    {
        $this->populateFixtures('I18NLanguagesAPI.yml');
        $this->createKernelWithMockServices([Services::AUTH_USER => $this->getMockAuthUser($testCaseParams)]);
        $this->registerServices($testCaseParams);
        $api = $this->getApiEndpointMock(I18NLanguageAPI::class, $testCaseParams);
        $this->assertValidTestCase($api, 'getAll', $testCaseParams);
    }

    public function dataProviderForTestGetAll(): array
    {
        return $this->getTestCases('I18NLanguagesAPITestCase.yml', 'GetAll');
    }

    /**
     * @dataProvider dataProviderForTestUpdate
     */
    public function testUpdate(TestCaseParams $testCaseParams): void
    {
        $this->populateFixtures('I18NLanguagesAPI.yml');
        $this->createKernelWithMockServices([Services::AUTH_USER => $this->getMockAuthUser($testCaseParams)]);
        $this->registerServices($testCaseParams);
        $api = $this->getApiEndpointMock(I18NLanguageAPI::class, $testCaseParams);
        $this->assertValidTestCase($api, 'update', $testCaseParams);
    }

    public function dataProviderForTestUpdate(): array
    {
        return $this->getTestCases('I18NLanguagesAPITestCase.yml', 'Update');
    }

    public function testCreate(): void
    {
        $api = new I18NLanguageAPI($this->getRequest());
        $this->expectNotImplementedException();
        $api->create();
    }

    public function testGetValidationRuleForCreate(): array
    {
        $api = new I18NLanguageAPI($this->getRequest());
        $this->expectNotImplementedException();
        $api->getValidationRuleForCreate();
    }

    public function testGetOne(): void
    {
        $api = new I18NLanguageAPI($this->getRequest());
        $this->expectNotImplementedException();
        $api->getOne();
    }

    public function testGetValidationRuleForGetOne(): array
    {
        $api = new I18NLanguageAPI($this->getRequest());
        $this->expectNotImplementedException();
        $api->getValidationRuleForGetOne();
    }

    public function testDelete(): void
    {
        $api = new I18NLanguageAPI($this->getRequest());
        $this->expectNotImplementedException();
        $api->delete();
    }

    public function testGetValidationRuleForDelete(): void
    {
        $api = new I18NLanguageAPI($this->getRequest());
        $this->expectNotImplementedException();
        $api->getValidationRuleForDelete();
    }
}
