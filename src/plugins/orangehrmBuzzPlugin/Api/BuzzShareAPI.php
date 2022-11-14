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

namespace OrangeHRM\Buzz\Api;

use OrangeHRM\Buzz\Api\Model\BuzzShareModel;
use OrangeHRM\Buzz\Traits\Service\BuzzServiceTrait;
use OrangeHRM\Core\Api\V2\CrudEndpoint;
use OrangeHRM\Core\Api\V2\Endpoint;
use OrangeHRM\Core\Api\V2\EndpointResourceResult;
use OrangeHRM\Core\Api\V2\EndpointResult;
use OrangeHRM\Core\Api\V2\RequestParams;
use OrangeHRM\Core\Api\V2\Validator\ParamRule;
use OrangeHRM\Core\Api\V2\Validator\ParamRuleCollection;
use OrangeHRM\Core\Api\V2\Validator\Rule;
use OrangeHRM\Core\Api\V2\Validator\Rules;
use OrangeHRM\Core\Traits\Auth\AuthUserTrait;
use OrangeHRM\Entity\BuzzShare;

class BuzzShareAPI extends Endpoint implements CrudEndpoint
{
    use BuzzServiceTrait;
    use AuthUserTrait;

    public const PARAMETER_TEXT = 'text';
    public const PARAMETER_SHARE_ID = 'shareId';

    /**
     * @inheritDoc
     */
    public function getAll(): EndpointResult
    {
        throw $this->getNotImplementedException();
    }

    /**
     * @inheritDoc
     */
    public function getValidationRuleForGetAll(): ParamRuleCollection
    {
        throw $this->getNotImplementedException();
    }

    /**
     * @inheritDoc
     */
    public function create(): EndpointResult
    {
        $shareId = $this->getRequestParams()->getInt(RequestParams::PARAM_TYPE_BODY, self::PARAMETER_SHARE_ID);
        $buzzShare = $this->getBuzzService()->getBuzzDao()->getBuzzShareById($shareId);
        if (!$buzzShare instanceof BuzzShare) {
            throw $this->getInvalidParamException(self::PARAMETER_SHARE_ID);
        }

        $share = new BuzzShare();
        $share->getDecorator()->setEmployeeByEmpNumber($this->getAuthUser()->getEmpNumber());
        $share->setPost($buzzShare->getPost());
        $share->setType(BuzzShare::TYPE_SHARE);
        $this->setBuzzShareText($share);
        $share->setCreatedAtUtc();
        $this->getBuzzService()->getBuzzDao()->saveBuzzShare($share);

        return new EndpointResourceResult(BuzzShareModel::class, $share);
    }

    /**
     * @param BuzzShare $buzzShare
     */
    private function setBuzzShareText(BuzzShare $buzzShare): void
    {
        $text = $this->getRequestParams()->getStringOrNull(RequestParams::PARAM_TYPE_BODY, self::PARAMETER_TEXT);
        $buzzShare->setText($text);
    }

    /**
     * @inheritDoc
     */
    public function getValidationRuleForCreate(): ParamRuleCollection
    {
        return new ParamRuleCollection(
            new ParamRule(
                self::PARAMETER_TEXT,
                new Rule(Rules::STRING_TYPE),
                new Rule(Rules::LENGTH, [null, BuzzPostAPI::PARAM_RULE_TEXT_MAX_LENGTH])
            ),
            new ParamRule(self::PARAMETER_SHARE_ID, new Rule(Rules::POSITIVE))
        );
    }

    /**
     * @inheritDoc
     */
    public function delete(): EndpointResult
    {
        throw $this->getNotImplementedException();
    }

    /**
     * @inheritDoc
     */
    public function getValidationRuleForDelete(): ParamRuleCollection
    {
        throw $this->getNotImplementedException();
    }

    /**
     * @inheritDoc
     */
    public function getOne(): EndpointResult
    {
        throw $this->getNotImplementedException();
    }

    /**
     * @inheritDoc
     */
    public function getValidationRuleForGetOne(): ParamRuleCollection
    {
        throw $this->getNotImplementedException();
    }

    /**
     * @inheritDoc
     */
    public function update(): EndpointResult
    {
        throw $this->getNotImplementedException();
    }

    /**
     * @inheritDoc
     */
    public function getValidationRuleForUpdate(): ParamRuleCollection
    {
        throw $this->getNotImplementedException();
    }
}
